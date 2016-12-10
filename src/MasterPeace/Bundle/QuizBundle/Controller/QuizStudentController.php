<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResult;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use MasterPeace\Bundle\QuizBundle\Form\QuizResultType;
use MasterPeace\Bundle\QuizBundle\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizStudentController extends Controller
{
    /**
     * @Route ("/quiz")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('student_quiz_list');
    }

    /**
     * @Route ("/quiz/list", name="student_quiz_list")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $quizzes = $em
            ->getRepository('MasterPeaceQuizBundle:Quiz')
            ->findAll();

        return $this->render('MasterPeaceQuizBundle:Quiz/Student:list.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * @Route ("/quiz/answer/{quiz}", name="student_quiz_answer")
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
        }

        return $this->render('@MasterPeaceQuiz/Quiz/Student/answer.html.twig', [
            'form' => $form->createView(),
            'quiz' => $quiz,
        ]);
    }
}
