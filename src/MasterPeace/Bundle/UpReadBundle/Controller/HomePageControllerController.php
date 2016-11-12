<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomePageControllerController extends Controller
{
    /**
     * @Route("/")
     */
    public function redirectAction()
    {
        return $this->render('MasterPeaceUserBundle::index.html.twig');
    }
}