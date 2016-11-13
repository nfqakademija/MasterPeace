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
        $response = null;

        if ($this->getUser()->isTeacher()) {
            $response = $this->render('MasterPeaceUpReadBundle:HomePage:teacher.html.twig');
        }

        if ($this->getUser()->isStudent()) {
            $response = $this->render('MasterPeaceUpReadBundle:HomePage:student.html.twig');
        }

        return $response;
    }
}
