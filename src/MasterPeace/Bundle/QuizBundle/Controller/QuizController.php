<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends Controller
{

    /**
     * @Route ("/list", name="quiz_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $books = $em
            ->getRepository('MasterPeaceQuizBundle:Quiz')
            ->findAll();

        return $this->render('MasterPeaceQuizBundle:Quiz:list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/create", name="quiz_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $this->getDoctrine()->getManager();
            $om->persist($form->getData());
            $om->flush();
        }

        return $this->render('@MasterPeaceQuiz/Quiz/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="quiz_edit")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $quiz = $this->getQuizOr404($id);
     var_dump($quiz->getQuestions()->toArray()[0]->getAnswers()->toArray()); die;
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $this->getDoctrine()->getManager();
            $om->persist($form->getData());
            $om->flush();
        }

        return $this->render('@MasterPeaceQuiz/Quiz/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param $id
     *
     * @return Quiz
     */
    private function getQuizOr404($id)
    {
        $quiz = $this->getDoctrine()->getRepository('MasterPeaceQuizBundle:Quiz')->findFull($id);

        if (null === $quiz) {
            $this->createNotFoundException('Not found quiz');
        }

        return $quiz;
    }
}
