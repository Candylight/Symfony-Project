<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 20/10/2016
 * Time: 15:21
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use AppBundle\Form\EventType;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    /**
     * @Route("/event/create/{id}", name="new_event", defaults={"id": 0})
     */
    public function newEventAction($id)
    {
        $event = new Event();
        if($id != 0)
        {
            $event = $this->getDoctrine()->getRepository('AppBundle:Event')->find($id);
        }

        $form = $this->createForm(EventType::class,$event, array(
            'action'=>"save_event",
            'user' => $this->get('security.token_storage')->getToken()->getUser()
        ));
        return $this->render('event/newEvent.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/event/save/{id}", name="save_event")
     */
    public function saveEventAction(Event $event,Request $request)
    {
        if($event == null)
        {
            $event = new Event;
        }

        if($request->getMethod() == "POST")
        {
            $form = $this->createForm(EventType::class,$event);
            $form->handleRequest($request);

            if($form->isValid())
            {

            }
        }

        return $this->redirectToRoute('list_event');
    }

    /**
     * @Route("/event/list", name="list_event")
     */
    public function eventListAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findBy(array('owner' => $user),array('dateStart' => 'ASC'));

        return $this->render('event/listEvent.html.twig',array(
            "events" => $events
        ));
    }
}