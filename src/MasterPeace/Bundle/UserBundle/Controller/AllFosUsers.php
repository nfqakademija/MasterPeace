<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AllFosUsers extends Controller
{
    /**
     * @Route("/allusers")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('MasterPeaceUserBundle:User');

        $users = $repository->findAll();

        return $this->render('', ['users' => $users]);
    }
}
