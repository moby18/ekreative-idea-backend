<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class APIController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/logout")
     * @Template()
     */
    public function logoutAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/register")
     * @Template()
     */
    public function registerAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaList")
     * @Template()
     */
    public function ideaListAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaItem")
     * @Template()
     */
    public function ideaItemAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaSubmit")
     * @Template()
     */
    public function ideaSubmitAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaCommentList")
     * @Template()
     */
    public function ideaCommentListAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaLike")
     * @Template()
     */
    public function ideaLikeAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/ideaDislike")
     * @Template()
     */
    public function ideaDislikeAction()
    {
        return array(
                // ...
            );    }

}
