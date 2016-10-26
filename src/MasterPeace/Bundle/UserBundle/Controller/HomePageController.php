<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePageRender()
    {
        return $this->render('MasterPeaceUserBundle::index.html.twig');
    }
}
