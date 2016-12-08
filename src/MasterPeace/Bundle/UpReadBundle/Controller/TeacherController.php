<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    /**
     * @Route("/", name="teacher_homepage")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('MasterPeaceUpReadBundle:HomePage:teacher.html.twig');
    }
}
