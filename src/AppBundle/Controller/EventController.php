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
     * @Route("/event/create/{id}", name="new_event")
     */
    public function newEventAction(Event $event)
    {
        if($event == null)
        {
            $event = new Event;
        }

        $form = $this->createForm(EventType::class,$event, array('action'=>"save_event"));
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
     * @Route("/event/list/{id}", name="list_event")
     */
    public function eventListAction(User $user)
    {

    }
}