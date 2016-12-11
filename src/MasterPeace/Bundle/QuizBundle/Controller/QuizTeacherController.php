<?php

namespace MasterPeace\Bundle\QuizBundle\Controller;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Form\QuizType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_TEACHER')")
 */
class QuizTeacherController extends Controller
{
    /**
     * @Route ("/quiz")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('teacher_quiz_list');
    }

    /**
     * @Route ("/quiz/list", name="teacher_quiz_list")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $quizzes = $em->getRepository('MasterPeaceQuizBundle:Quiz')->findBy([
            'teacher' => $this->getUser()->getId(),
        ]);

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:list.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * @Route ("/quiz/view/{id}", name="teacher_quiz_view")
     *
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function viewAction(Quiz $quiz): Response
    {
        $this->validateEntityCreator('View', $quiz);
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
    public function createAction(Request $request): Response
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

            return $this->redirectToRoute('teacher_quiz_view', [
                'id' => $quiz->getId(),
            ]);
        }

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quiz/edit/{id}", name="teacher_quiz_edit")
     *
     * @param Request $request
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function editAction(Request $request, Quiz $quiz): Response
    {
        $this->validateEntityCreator('Edit', $quiz);
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

            return $this->redirectToRoute('teacher_quiz_view', [
                'id' => $quiz->getId(),
            ]);
        }

        return $this->render('MasterPeaceQuizBundle:Quiz/Teacher:edit.html.twig', [
            'form' => $form->createView(),
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route ("/quiz/delete/{id}", name="teacher_quiz_delete")
     *
     * @param Quiz $quiz
     *
     * @return Response
     */
    public function deleteAction(Quiz $quiz): Response
    {
        $this->validateEntityCreator('Delete', $quiz);
        $em = $this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('teacher_quiz_list');
    }

    /**
     * @param string $actionName
     * @param Quiz $quiz
     */
    private function validateEntityCreator(string $actionName, Quiz $quiz)
    {
        if ($this->getUser() !== $quiz->getTeacher()) {
            throw $this->createNotFoundException(strtoupper($actionName).': Classroom not found');
        }
    }
}
