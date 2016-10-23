<?php
/**
 * Created by PhpStorm.
 * User: Karolis Matjosaitis
 * Date: 10/15/16
 * Time: 10:25 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

# Templating service, renders templates.
# base Controller gets access to service container.

class templateController extends Controller
{
    /**
     * @Route("/template/{templateName}")
     */
    public function showAction($templateName)
    {
        # gets templating service. Container has only one method: get(). Give nickname to service and it
        # it will return that object.
        #render template:
        return $this->render('template/show.html.twig', [
            # passing variables
            'name' => $templateName
        ]);
    }
}