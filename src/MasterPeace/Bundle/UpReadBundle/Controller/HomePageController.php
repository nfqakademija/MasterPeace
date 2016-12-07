<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function redirectAction()
    {
        if ($this->getUser()->isTeacher()) {
            return $this->render('MasterPeaceUpReadBundle:HomePage:teacher.html.twig');
        }

        return $this->render('MasterPeaceUpReadBundle:HomePage:student.html.twig');
    }
}
