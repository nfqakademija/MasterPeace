<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route ("/classroom/list", name="student_classroom_list")
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
     * @Route ("/classroom/delete/{id}", name="student_classroom_delete")  // TODO: make DELETE only for own Classroom
     *
     * @param Classroom $classroom
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function deleteAction(Classroom $classroom): Response    // TODO: not DELETE, but LEAVE
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('student_classroom_list');
    }
}
