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
}