<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizTeacherController extends Controller
{
    /**
     * @Route ("/quiz")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->redirectToRoute('teacher_quiz_list');
    }

    /**
     * @Route ("/quiz/list", name="teacher_quiz_list")
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

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:list.html.twig', [
            'quizes' => $quizes,
        ]);
    }

    /**
     * @Route ("/quiz/view/{id}", name="teacher_quiz_view")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $quiz = $em
            ->getRepository('MasterPeaceQuizBundle:Quiz')
            ->find($id);

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:view.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route("/quiz/create", name="teacher_quiz_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $quiz = new Quiz();
        $quiz->setTeacher($this->getUser());
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $this->getDoctrine()->getManager();

            foreach ($quiz->getQuestions() as $question) {
                $question->setQuiz($quiz);
                $om->persist($question);
            }

            $om->persist($quiz);
            $om->flush();
        }

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quiz/edit/{id}", name="teacher_quiz_edit")
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function editAction(Request $request, int $id)
    {
        $quiz = $this->getQuizOr404($id);
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $this->getDoctrine()->getManager();

            foreach ($quiz->getQuestions() as $question) {
                $question->setQuiz($quiz);
                $om->persist($question);
            }

            $om->persist($quiz);
            $om->flush();

            return $this->redirectToRoute('teacher_quiz_list');
        }

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/quiz/delete/{id}", name="teacher_quiz_delete")
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $quiz = $this->getQuizOr404($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('teacher_quiz_list');
    }

    /**
     * @param int $id
     *
     * @return Quiz
     */
    private function getQuizOr404(int $id)
    {
        $quiz = $this->getDoctrine()->getRepository('MasterPeaceQuizBundle:Quiz')->findFull($id);

        if (null === $quiz) {
            $this->createNotFoundException('Not found quiz');
        }

        return $quiz;
    }
}
