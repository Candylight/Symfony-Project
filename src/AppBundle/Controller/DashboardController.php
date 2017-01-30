<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 08/11/2016
 * Time: 13:53
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/dashboard/eventTab", name="dashboardEventTab")
     */
    public function eventTabAction(Request $request)
    {
        if($request->getMethod() == "POST")
        {
            //chargement au changement d'onglet, Attention bien utiliser renderView en cas de Response
            return new Response($this->renderView(':dashboard:eventTab.html.twig'));
        }

        //Chargement par défaut
        return $this->render(':dashboard:eventTab.html.twig');
    }

    /**
     * @Route("/dashboard/newEventTab", name="dashboardNewEventTab")
     */
    public function newEventTabAction(Request $request)
    {
        $form = $this->createForm(EventType::class,new Event(), array('action'=>"save_event"));

        return new Response($this->renderView('event/newEvent.html.twig',array(
            'form' => $form->createView()
        )));
    }
}