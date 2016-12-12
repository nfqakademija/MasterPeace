<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_STUDENT')")
 */
class ClassroomStudentController extends Controller
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
        return $this->redirectToRoute('student_classroom_list');
    }

    /**
     * @Route ("/classroom/list", name="student_classroom_list")  // TODO: make LIST only for own Classrooms
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $classrooms = $em->getRepository('MasterPeaceClassroomBundle:Classroom')->findAll();
        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/classroom/view/{id}", name="student_classroom_view")  // TODO: make VIEW only for own Classroom
     *
     * @param Classroom $classroom
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function viewAction(Classroom $classroom): Response
    {
        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:view.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/classroom/leave/{id}", name="student_classroom_leave")  // TODO: make LEAVE only for own Classroom
     *
     * @param Request $request
     * @param Classroom $classroom
     *
     * @Method("DELETE")
     *
     * @return Response
     */
    public function leaveAction(Request $request, Classroom $classroom): Response
    {
        if (false === $this->isCsrfTokenValid($classroom->getId(), $request->request->get('token'))) {
            throw $this->createAccessDeniedException('DELETE: CSRF token is invalid');
        }
        $em = $this->getDoctrine()->getManager();
        $classroom->removeStudent($this->getUser());
        $em->persist($classroom);
        $em->flush();

        return $this->redirectToRoute('student_classroom_list');
    }
}
