<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('default/index.html.twig', array(
            'events' => $this->getDoctrine()->getRepository('AppBundle:Event')->findBy(array('owner'=>$this->getUser())),
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
