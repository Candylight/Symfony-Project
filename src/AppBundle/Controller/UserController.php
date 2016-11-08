<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 20/10/2016
 * Time: 15:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/findUser", name="findUser")
     */
    public function findUserAction()
    {
        return new Response($this->renderView("user/findUser.html.twig"));
    }

    /**
     * @Route("/findUser/search", name="searchUser")
     */
    public function searchUserAction(Request $request)
    {
        $keyword = $request->get('keyword',null);

        $users = array();
        if($keyword != null && $keyword != "")
        {
            $users = $this->getDoctrine()->getRepository("AppBundle:User")->findByKeyword($keyword);
        }

        return new Response($this->renderView("user/searchUser.html.twig",array(
            "users" => $users
        )));
    }
}