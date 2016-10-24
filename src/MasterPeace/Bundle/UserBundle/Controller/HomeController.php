<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
        return $this->render('MasterPeaceUserBundle::index.html.twig');
    }
}
