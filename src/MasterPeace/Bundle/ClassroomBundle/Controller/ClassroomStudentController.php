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
     * @Route ("/classroom/list", name="student_classroom_list")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $classrooms = $em
            ->getRepository('MasterPeaceClassroomBundle:Classroom')
            ->getStudentClassrooms($this->getUser());

        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/classroom/view/{id}", name="student_classroom_view")
     *
     * @param Classroom $classroom
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function viewAction(Classroom $classroom): Response
    {
        if (false === $this->hasClassroom($classroom)) {
            throw $this->createAccessDeniedException('Student dont have access');
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:view.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/classroom/leave/{id}", name="student_classroom_leave")
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
        if (false === $this->hasClassroom($classroom)) {
            throw $this->createAccessDeniedException('Student do not have access to classroom');
        }

        $csrfId = $classroom->getTitle() . $classroom->getId();

        if (false === $this->isCsrfTokenValid($csrfId, $request->request->get('token'))) {
            throw $this->createAccessDeniedException('DELETE: CSRF token is invalid');
        }

        $em = $this->getDoctrine()->getManager();
        $classroom->removeStudent($this->getUser());
        $em->persist($classroom);
        $em->flush();

        return $this->redirectToRoute('student_classroom_list');
    }

    /**
     * @param Classroom $classroom
     *
     * @return bool
     */
    private function hasClassroom(Classroom $classroom)
    {
        $user = $this->getUser();

        foreach ($classroom->getStudents() as $student) {
            if ($user === $student) {
                return true;
            }
        }

        return false;
    }
}
