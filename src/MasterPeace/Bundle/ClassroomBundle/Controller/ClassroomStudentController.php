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
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $classroom = $em
            ->getRepository('MasterPeaceClassroomBundle:Classroom')
            ->find($id);

        return $this->render('MasterPeaceClassroomBundle:Classroom/Student:view.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/classroom/delete/{id}", name="student_classroom_delete")
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id): Response
    {
        $classroom = $this->getClassroomOr404($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('student_classroom_list');
    }

    /**
     * @param int $id
     *
     * @return Classroom
     */
    private function getClassroomOr404(int $id): Classroom
    {
        $classroom = $this->getDoctrine()->getRepository('MasterPeaceClassroomBundle:Classroom')->find($id);

        if (null === $classroom) {
            $this->createNotFoundException('Classroom not found');
        }

        return $classroom;
    }

    /**
     * @return ClassroomRepository|object
     */
    private function getClassroomRepository()
    {
        return $this->get('masterpeace.classroom.repository');
    }
}
