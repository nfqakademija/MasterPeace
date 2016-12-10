<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\ClassroomBundle\Repository\ClassroomRepository;
use phpDocumentor\Reflection\Types\Object_;
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
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('student_classroom_list');
    }

    /**
     * @Route ("/classroom/list", name="student_classroom_list")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $repo = $this->getClassroomRepository();
        $classrooms = $repo->findAll();

        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/classroom/view/{id}", name="student_classroom_view")
     *
     * @param Classroom $classroom
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
     * @Route ("/classroom/delete/{id}", name="student_classroom_delete")
     *
     * @param Classroom $classroom
     *
     * @return Response
     */
    public function deleteAction(Classroom $classroom): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('student_classroom_list');
    }

    /**
     * @return ClassroomRepository|object
     */
    private function getClassroomRepository()
    {
        return $this->get('masterpeace.classroom.repository');
    }
}
