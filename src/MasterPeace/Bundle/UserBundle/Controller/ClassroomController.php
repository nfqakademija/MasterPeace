<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use MasterPeace\Bundle\UserBundle\Entity\Classroom;
use MasterPeace\Bundle\UserBundle\Form\ClassroomType;
use MasterPeace\Bundle\UserBundle\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends Controller
{
    /**
     * @Route ("/list", name="classroom_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $repo = $this->getClassroomRepository();
        $classrooms = $repo->findAll();

        return $this->render('MasterPeaceUserBundle:classroom:classroom_list.html.twig', [
            'classrooms' => $classrooms,
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

        return $this->render('MasterPeaceUserBundle:classroom:classroom_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return ClassroomRepository|object
     */
    private function getClassroomRepository()
    {
        return $this->get('masterpeace_user.repository.classroom');
    }
}
