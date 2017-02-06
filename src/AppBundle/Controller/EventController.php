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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EventController extends Controller
{
    /**
     * @Route("/event/create", name="new_event")
     */
    public function newEventAction()
    {
        $form = $this->createForm(EventType::class,new Event, array(
            'action'=> $this->generateUrl('save_event'),
            'user' => $this->get('security.token_storage')->getToken()->getUser()
        ));
        return $this->render('event/newEvent.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/event/update/{id}", name="updateEvent", requirements={"id": "\d+"})
     *
     * @param Event $event
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateEventCategoryAction(Event $event = null)
    {
        $session = new Session();

        if(is_a($event,'AppBundle\Entity\Event'))
        {
            $form = $this->createForm(EventType::class,$event,array(
                "method" => "POST",
                "action"=> $this->generateUrl("save_event",array("id"=>$event->getId())),
                "user" => $this->get('security.token_storage')->getToken()->getUser()
            ));

            return $this->render(':event:updateEvent.html.twig', array(
                "form" => $form->createView(),
                "event" => $event
            ));
        }
        else
        {
            $session->getFlashBag()->add('warning', $this->get('translator')->trans('event.error'));

            return $this->redirectToRoute('list_event');
        }
    }

    /**
     * @Route("/event/save/{id}", name="save_event", defaults={"id" = 0})
     */
    public function saveEventAction(Request $request,Event $event = null)
    {
        $session = new Session();

        if($event != null)
        {
            $session->getFlashBag()->add('success', $this->get('translator')->trans('event.updatedNotif'));
        }
        else
        {
            $event = new Event();
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($request->getMethod() == "POST")
        {
            $form = $this->createForm(EventType::class,$event,array(
                'user' => $user
            ));
            $form->handleRequest($request);

            if($form->isValid())
            {

                $geocode = $this->get('app.geocodingfunctions')->getGeocode($request->get('address'));

                if(!$geocode)
                {
                    return $this->redirectToRoute('new_event');
                }

                list($address,$town,$country) = explode(', ',$request->get('address'));

                $event->setLatitude($geocode['lat']);
                $event->setLongitude($geocode['lng']);
                $event->setAddress($address);
                $event->setTown($town);
                $event->setCountry($country);
                $event->setOwner($user);
                $event->addParticipant($user);


                $this->getDoctrine()->getManager()->persist($event);
                $this->getDoctrine()->getManager()->flush();
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

        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findBy(array('owner' => $user->getId()),array('dateStart' => 'ASC'));

        return $this->render('event/listEvent.html.twig',array(
            "events" => $events
        ));
    }

    /**
     * @Route("/event/delete/{id}", name="deleteEvent")
     * @param Event $event
     *
     * @return RedirectResponse
     */
    public function deleteEventAction(Event $event = null)
    {
        $session = new Session();

        if(is_a($event,'AppBundle\Entity\Event'))
        {
            $this->getDoctrine()->getManager()->remove($event);
            $this->getDoctrine()->getManager()->flush();

            $session->getFlashBag()->add('success', $this->get('translator')->trans('event.deletedNotif'));
        }
        else
        {
            $session->getFlashBag()->add('warning', $this->get('translator')->trans('event.error'));
        }

        return $this->redirectToRoute('list_event');
    }
}