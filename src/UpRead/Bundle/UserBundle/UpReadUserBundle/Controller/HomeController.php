<?php

namespace UpRead\Bundle\UserBundle\UpReadUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
        return $this->render('UpReadUserBundle::index.html.twig');
    }
}
