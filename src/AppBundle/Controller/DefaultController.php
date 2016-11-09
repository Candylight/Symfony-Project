<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
    /**
     * @Route("/dayevent", name="dayevent")
     */
    public function dayeventAction(Request $request)
    {
        $events = $this->getDoctrine()->getRepository("AppBundle:Event")->findAll();

        return $this->render('map/daymap.html.twig', array(
            'events' => $events
        ));
    }
}
