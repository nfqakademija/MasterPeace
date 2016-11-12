<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use MasterPeace\Bundle\UserBundle\Entity\Classroom;
use MasterPeace\Bundle\UserBundle\Form\ClassroomType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassroomController extends Controller
{
    /**
     * @Route ("/list", name="classroom_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $classrooms = $em
            ->getRepository('MasterPeaceUserBundle:Classroom')
            ->findAll();

        return $this->render('MasterPeaceUserBundle::classroomList.html.twig', [
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
        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->setData($classroom);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();

            return $this->redirectToRoute('classroom_list');
        }

        return $this->render('MasterPeaceUserBundle::classroomCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}