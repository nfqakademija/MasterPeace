<?php

namespace MasterPeace\Bundle\ClassroomBundle\Controller;

use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\ClassroomBundle\Form\ClassroomType;
use MasterPeace\Bundle\ClassroomBundle\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends Controller
{
    /**
     * @Route ("/")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->redirectToRoute('classroom_list');
    }

    /**
     * @Route ("/list", name="classroom_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $repo = $this->getClassroomRepository();
        $classrooms = $repo->findAll();

        return $this->render('MasterPeaceClassroomBundle:Classroom:list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/student/list", name="classroom_student_list")
     *
     * @return Response
     */
    public function studentListAction()
    {
        $repo = $this->getClassroomRepository();
        $classrooms = $repo->findAll();

        return $this->render('MasterPeaceClassroomBundle:Classroom:studentList.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * @Route ("/view/{id}", name="classroom_view")
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
        $classroom = $em
            ->getRepository('MasterPeaceClassroomBundle:Classroom')
            ->find($id);

        return $this->render('MasterPeaceClassroomBundle:Classroom:view.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/create", name="classroom_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $classroom = new Classroom();
        $classroom->setTeacher($this->getUser());
        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->setData($classroom);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getClassroomRepository()->add($classroom);

            return $this->redirectToRoute('classroom_list');
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/edit/{id}", name="classroom_edit")
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request, int $id)
    {
        $classroom = $this->getClassroomOr404($id);

        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('classroom_view', [
                'id' => $id,
            ]);
        }

        return $this->render('MasterPeaceClassroomBundle:Classroom:edit.html.twig', [
            'form'      => $form->createView(),
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route ("/delete/{id}", name="classroom_delete")
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $classroom = $this->getClassroomOr404($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('classroom_list');
    }

    /**
     * @param int $id
     *
     * @return Classroom
     */
    private function getClassroomOr404(int $id)
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
