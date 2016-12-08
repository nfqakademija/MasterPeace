<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * @Route("/", name="student_homepage")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('MasterPeaceUpReadBundle:HomePage:student.html.twig');
    }
}
