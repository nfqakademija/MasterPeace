<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function redirectAction()
    {
        if ($this->getUser()->isAdmin()) {
            return $this->render('MasterPeaceUpReadBundle::admin.html.twig');
        }

        if ($this->getUser()->isTeacher()) {
            return $this->render('MasterPeaceUpReadBundle::teacher.html.twig');
        }

        if ($this->getUser()->isStudent()) {
            return $this->render('MasterPeaceUpReadBundle::student.html.twig');
        }
    }
}
