<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectUserAction()
    {
        $response = null;

        if ($this->getUser()->isTeacher()) {
            $response = $this->render('MasterPeaceUpReadBundle::teacher.html.twig');
        }

        if ($this->getUser()->isStudent()) {
            $response = $this->render('MasterPeaceUpReadBundle::student.html.twig');
        }

        if ($this->getUser()->isAdmin()) {
            $response = $this->render('MasterPeaceUpReadBundle::admin.html.twig');
        }

        return $response;
    }

    /**
     * @Route("/admin", name="admin")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectAdminAction()
    {
        $response = null;

        if ($this->getUser()->isAdmin()) {
            $response = $this->render('MasterPeaceUpReadBundle::admin.html.twig');
        } else {
            $response = $this->render('MasterPeaceUserBundle::layout.html.twig');
        }

        return $response;
    }
}
