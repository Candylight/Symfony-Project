<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 20/10/2016
 * Time: 15:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
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

        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        $users = array();
        if($keyword != null && $keyword != "")
        {
            $users = $this->getDoctrine()->getRepository("AppBundle:User")->findByKeyword($keyword,$currentUser->getId());
        }

        return new Response($this->renderView("user/searchUser.html.twig",array(
            "users" => $users,
            "currentUser" => $currentUser
        )));
    }

    /**
     * @Route("/addFriend/{id}", name="addFriend")
     *
     * @param User $friend
     *
     * @return string
     */
    public function addFriendAction(User $friend)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        if(!$currentUser->isFriend($friend))
        {
            $currentUser->addFriend($friend);
            $friend->addFriend($currentUser);

            $this->getDoctrine()->getManager()->persist($currentUser);
            $this->getDoctrine()->getManager()->persist($friend);
            $this->getDoctrine()->getManager()->flush();

            return new Response('ok');
        }

        return new Response('nok');
    }

    /**
     * @Route("/removeFriend/{id}", name="removeFriend")
     *
     * @param User $friend
     *
     * @return string
     */
    public function removeFriendAction(User $friend)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        if($currentUser->isFriend($friend))
        {
            $currentUser->removeFriend($friend);
            $friend->removeFriend($currentUser);

            $this->getDoctrine()->getManager()->persist($currentUser);
            $this->getDoctrine()->getManager()->persist($friend);
            $this->getDoctrine()->getManager()->flush();

            return new Response('ok');
        }

        return new Response('nok');
    }
}