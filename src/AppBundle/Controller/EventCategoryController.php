<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 20/10/2016
 * Time: 15:25
 */

namespace AppBundle\Controller;


use AppBundle\Entity\EventCategory;
use AppBundle\Form\EventCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @Route("/eventCategory/new/{id}", name="newEventCategory", requirements={"id": "\d+"})
     *
     * @param integer $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newEventCategory($id = -1)
    {
        $eventCategory = new EventCategory();
        if($id > 0)
        {
            $eventCategory = $this->getDoctrine()->getRepository("AppBundle:EventCategory")->find($id);
        }

        $form = $this->createForm(EventCategoryType::class,$eventCategory,array(
            "method" => "POST",
            "action"=> $this->generateUrl("saveEventCategory",array("id"=>$eventCategory->getId()))
        ));

        return $this->render(":eventCategory:newEventCategory.html.twig",array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/eventCategory/save/{id}", name="saveEventCategory", requirements={"page": "\d+"})
     *
     * @param Request $request
     * @param integer $id
     *
     * @return RedirectResponse
     */
    public function saveEventCategoryAction(Request $request, $id = -1)
    {
        $eventCategory = new EventCategory();
        if($id > 0)
        {
            $eventCategory = $this->getDoctrine()->getRepository("AppBundle:EventCategory")->find($id);
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
}