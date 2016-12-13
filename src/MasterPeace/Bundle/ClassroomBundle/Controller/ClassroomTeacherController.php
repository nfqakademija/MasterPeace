<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\ClassroomBundle\Form\ClassroomType;
use MasterPeace\Bundle\ClassroomBundle\Form\QuizAttachType;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_TEACHER')")
 */
class ClassroomTeacherController extends Controller
{
    /**
     * @Route ("/classroom")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('teacher_classroom_list');
    }

    /**
     * @Route ("/classroom/list", name="teacher_classroom_list")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $classrooms = $em->getRepository('MasterPeaceClassroomBundle:Classroom')->findBy([
            'teacher' => $this->getUser()->getId(),
        ]);
        return $this->render('MasterPeaceClassroomBundle:Classroom/Teacher:list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/classroom/view/{id}", name="teacher_classroom_view")
     *
     * @param Request $request
     * @param Classroom $classroom
     *
     * @return Response
     *
     * @Method({"GET", "POST"})
     */
    public function viewAction(Request $request, Classroom $classroom): Response
    {
        $this->validateEntityCreator('View', $classroom);

        $form = $this->createForm(QuizAttachType::class, null, ['teacher' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $classroom->addQuiz($form->getData()['quiz']);
            $em->persist($classroom);
            $em->flush();
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom/Teacher:view.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/classroom/create", name="teacher_classroom_create")
     *
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $classroom = new Classroom();
        $classroom->setTeacher($this->getUser());
        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();

            return $this->redirectToRoute('teacher_classroom_list');
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom/Teacher:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/classroom/edit/{id}", name="teacher_classroom_edit")
     *
     * @param Classroom $classroom
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function editAction(Request $request, Classroom $classroom): Response
    {
        $this->validateEntityCreator('Edit', $classroom);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('teacher_classroom_view', [
                'id' => $classroom->getId(),
            ]);
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom/Teacher:edit.html.twig', [
            'form'      => $form->createView(),
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/classroom/delete/{id}", name="teacher_classroom_delete")
     *
     * @param Request $request
     * @param Classroom $classroom
     *
     * @Method("DELETE")
     *
     * @return Response
     */
    public function deleteAction(Request $request, Classroom $classroom): Response
    {
        $this->validateCsrf($request, $classroom);
        $this->validateEntityCreator('Delete', $classroom);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('teacher_classroom_list');
    }

    /**
     * @Route ("/classroom/view/{classroom}/detach/{quiz}", name="teacher_classroom_detach")
     *
     * @param Request $request
     * @param Classroom $classroom
     * @param Quiz $quiz
     *
     * @return Response
     * @Method("DELETE")
     */
    public function detachAction(Request $request, Classroom $classroom, Quiz $quiz): Response
    {
        $this->validateCsrf($request, $classroom);
        $em = $this->getDoctrine()->getManager();
        $classroom->removeQuiz($quiz);
        $em->persist($classroom);
        $em->flush();

        return $this->redirectToRoute('teacher_classroom_view', [
            'id' => $classroom->getId(),
        ]);
    }

    /**
     * @Route ("/classroom/view/{classroom}/studentdetach/{student}", name="teacher_student_detach")
     *
     * @param Request $request
     * @param Classroom $classroom
     * @param User $student
     *
     * @return Response
     *
     * @Method("DELETE")
     */
    public function detachStudentAction(Request $request, Classroom $classroom, User $student): Response
    {
        $this->validateCsrf($request, $classroom);
        $em = $this->getDoctrine()->getManager();
        $classroom->removeStudent($student);
        $em->persist($classroom);
        $em->flush();

        return $this->redirectToRoute('teacher_classroom_view', [
            'id' => $classroom->getId(),
        ]);
    }

    /**
     * @param string $actionName
     * @param Classroom $classroom
     */
    private function validateEntityCreator(string $actionName, Classroom $classroom)
    {
        if ($this->getUser() !== $classroom->getTeacher()) {
            throw $this->createNotFoundException(strtoupper($actionName).': Classroom not found');
        }
    }

    /**
     * @param Request $request
     * @param Classroom $classroom
     */
    private function validateCsrf(Request $request, Classroom $classroom)
    {
        $csrfId = $classroom->getTitle() . $classroom->getId();

        if (false === $this->isCsrfTokenValid($csrfId, $request->request->get('token'))) {
            throw $this->createAccessDeniedException('DELETE: CSRF token is invalid');
        }
    }
}
