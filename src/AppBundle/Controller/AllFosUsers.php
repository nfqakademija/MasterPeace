<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AllFosUsers extends Controller
{
    /**
     * @Route("/allusers")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $users = $repository->findAll();
        return $this->render('FOSUserBundle:Admin:allusers.html.twig', array('users' => $users));
    }

}