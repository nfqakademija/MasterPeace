<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
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
    public function indexAction()
    {
        return $this->redirectToRoute('student_quiz_list');
    }

    /**
     * @Route ("/quiz/list", name="student_quiz_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $quizes = $em
            ->getRepository('MasterPeaceQuizBundle:Quiz')
            ->findAll();

        return $this->render('MasterPeaceQuizBundle:Quiz/Student:list.html.twig', [
            'quizes' => $quizes,
        ]);
    }
}
