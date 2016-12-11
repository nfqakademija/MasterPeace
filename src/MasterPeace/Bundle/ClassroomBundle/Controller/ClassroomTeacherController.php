<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\ClassroomBundle\Form\ClassroomType;
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
     * @param Classroom $classroom
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function viewAction(Classroom $classroom): Response
    {
        $this->validateEntityCreator('View', $classroom);
        return $this->render('MasterPeaceClassroomBundle:Classroom/Teacher:view.html.twig', [
            'classroom' => $classroom,
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

        $form->setData($classroom);
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
     * @param Classroom $classroom
     *
     * @Method("DELETE")
     *
     * @return Response
     */
    public function deleteAction(Classroom $classroom): Response
    {
        $this->validateEntityCreator('Delete', $classroom);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('teacher_classroom_list');
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
}
