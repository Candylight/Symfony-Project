<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 20/10/2016
 * Time: 15:25
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use AppBundle\Entity\EventCategory;
use AppBundle\Form\EventCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class EventCategoryController extends Controller
{
    /**
     * @Route("/eventCategory/list", name="listEventCategory")
     */
    public function listEventCategoryAction()
    {
        return $this->render(":eventCategory:listEventCategory.html.twig",array(
            "categories" => $this->getDoctrine()->getRepository("AppBundle:EventCategory")->findAll()
        ));
    }

    /**
     * @Route("/eventCategory/new", name="newEventCategory")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newEventCategoryAction()
    {
        $form = $this->createForm(EventCategoryType::class,new EventCategory(),array(
            "method" => "POST",
            "action"=> $this->generateUrl("saveEventCategory")
        ));

        return $this->render(':eventCategory:newEventCategory.html.twig', array(
                "form" => $form->createView()
            ));
    }

    /**
     * @Route("/eventCategory/update/{id}", name="updateEventCategory", requirements={"id": "\d+"})
     *
     * @param EventCategory $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateEventCategoryAction(EventCategory $category = null)
    {
        $session = new Session();

        if(is_a($category,'AppBundle\Entity\EventCategory'))
        {
            $form = $this->createForm(EventCategoryType::class,$category,array(
                "method" => "POST",
                "action"=> $this->generateUrl("saveEventCategory",array("id"=>$category->getId()))
            ));

            return $this->render(':eventCategory:updateEventCategory.html.twig', array(
                "form" => $form->createView()
            ));
        }
        else
        {
            $session->getFlashBag()->add('warning', $this->get('translator')->trans('eventCategory.error'));

            return $this->redirectToRoute('listEventCategory');
        }
    }

    /**
     * @Route("/eventCategory/save/{id}", name="saveEventCategory", requirements={"page": "\d+"})
     *
     * @param Request $request
     * @param integer $id
     *
     * @return RedirectResponse
     */
    public function saveEventCategoryAction(Request $request, $id = 0)
    {
        $session = new Session();

        $eventCategory = new EventCategory();
        if($id != 0)
        {
            $eventCategory = $this->getDoctrine()->getRepository("AppBundle:EventCategory")->find($id);
            $session->getFlashBag()->add('success', $this->get('translator')->trans('eventCategory.updated'));
        }

        $form = $this->createForm(EventCategoryType::class,$eventCategory);

        if($request->getMethod() == "POST")
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($eventCategory);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->redirectToRoute("listEventCategory");
    }

    /**
     * @Route("/eventCategory/delete/{id}", name="deleteEventCategory")
     * @param EventCategory $category
     *
     * @return RedirectResponse
     */
    public function deleteEventCategoryAction(EventCategory $category = null)
    {
        $session = new Session();

        if(is_a($category,'AppBundle\Entity\EventCategory'))
        {
            $this->getDoctrine()->getManager()->remove($category);
            $this->getDoctrine()->getManager()->flush();

            $session->getFlashBag()->add('success', $this->get('translator')->trans('eventCategory.deletedNotif'));
        }
        else
        {
            $session->getFlashBag()->add('warning', $this->get('translator')->trans('eventCategory.error'));
        }

        return $this->redirectToRoute('listEventCategory');
    }
}
