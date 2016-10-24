<?php

namespace UpRead\Bundle\UserBundle\UpReadUserBundle\Controller;

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
            ->getRepository('UpReadUserBundle:User');

        $users = $repository->findAll();
        return $this->render('FOSUserBundle:Admin:allusers.html.twig', array('users' => $users));
    }

}
