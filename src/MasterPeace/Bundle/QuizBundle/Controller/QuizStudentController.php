<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResult;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use MasterPeace\Bundle\QuizBundle\Factory\QuizResultFactory;
use MasterPeace\Bundle\QuizBundle\Form\QuizResultType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_STUDENT')")
 */
class QuizStudentController extends Controller
{
    /**
     * @Route ("/quiz/view/{id}", name="student_quiz_view")
     *
     * @Method("GET")
     *
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function viewAction(Quiz $quiz): Response
    {
        $this->hasAccessToQuiz($quiz);
        $result = $this->getDoctrine()
            ->getRepository('MasterPeaceQuizBundle:QuizResult') // TODO: neleisti dar karta atsakineti
            ->findOneBy(['quiz' => $quiz, 'student' => $this->getUser()]);

        return $this->render('MasterPeaceQuizBundle:Quiz/Student:view.html.twig', [
            'quiz' => $quiz,
            'result' => $result,
        ]);
    }

    /**
     * @Route ("/quiz/answer/{quiz}", name="student_quiz_answer")
     *
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function answerAction(Request $request, Quiz $quiz)
    {
        $this->hasAccessToQuiz($quiz);

        $result = QuizResultFactory::create($this->getUser(), $quiz);

        $form = $this->createForm(QuizResultType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $this->getDoctrine()->getManager();
            $om->persist($result);
            $om->flush();

            return $this->redirectToRoute('student_quiz_view', [
                'id' => $quiz->getId(),
            ]);
        }

        return $this->render('@MasterPeaceQuiz/Quiz/Student/answer.html.twig', [
            'form' => $form->createView(),
            'quiz' => $quiz,
        ]);
    }

    /**
     * @param Quiz $quiz
     */
    private function hasAccessToQuiz(Quiz $quiz)
    {
        $hasQuiz = $this->getDoctrine()
            ->getRepository('MasterPeaceUserBundle:User')
            ->hasStudentQuiz($this->getUser(), $quiz);

        if (false === $hasQuiz) {
            throw $this->createAccessDeniedException("Student do not have access to requested quiz");
        }
    }
}
