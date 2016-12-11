<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResult;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
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
     * @Route ("/quiz/view/{id}", name="student_quiz_view")  // TODO: VIEW only your Quiz
     *
     * @Method("GET")
     *
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function viewAction(Quiz $quiz): Response
    {
//        $this->validateEntityCreator('View', $quiz);
        return $this->render('MasterPeaceQuizBundle:Quiz/Student:view.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route ("/quiz/answer/{quiz}", name="student_quiz_answer") // TODO: answer only your Quiz and only ONE time
     *
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function answerAction(Request $request, Quiz $quiz) // TODO: extract answer creation to Factory
    {
        $result = new QuizResult();
        $result
            ->setStudent($this->getUser())
            ->setQuiz($quiz);


        foreach ($quiz->getQuestions() as $question) {
            $answer = new QuizResultAnswer();
            $answer->setQuestion($question);

            $result->addAnswer($answer);
        }

        $form = $this->createForm(QuizResultType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            var_dump($result->getAnswers()->toArray()); die;
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
}
