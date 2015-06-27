<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Idea;
use AppBundle\Form\IdeaType;
use Doctrine\ORM\EntityManager;
use Mcfedr\JsonFormBundle\Controller\JsonController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class APIController extends JsonController
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
     * @Route("/api/idea/list")
     * @ApiDoc(
     *  resource=true,
     *  description="Get Ideas list",
     *  statusCodes={
     *      200="Returned Ideas list"
     *  }
     * )
     * @Method("GET")
     * @return JsonResponse
     */
    public function getIdeaListAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Idea')->findAll();
        foreach ($items as &$item) {
            $image = $item->getImage();
            $item->setImage(!empty($image) ? $this->container->get('liip_imagine.cache.manager')->getBrowserPath($item->getWebPath(), 'idea_item') : null);
        }
        return JsonResponse::create($items, Response::HTTP_OK);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get Idea Details",
     *  statusCodes={
     *      200="Returned Idea Details",
     *  }
     * )
     * @Route("/api/idea/item/{id}")
     * @ParamConverter("idea", class="AppBundle:Idea")
     * @Method("GET")
     * @param Idea $idea
     * @return JsonResponse
     */
    public function getIdeaItemAction(Idea $idea)
    {
        $image = $idea->getImage();
        $idea->setImage(!empty($image) ? $this->container->get('liip_imagine.cache.manager')->getBrowserPath($idea->getWebPath(), 'idea_item') : null);
        return JsonResponse::create($idea, Response::HTTP_OK);
    }

    /**
     * @Route("/api/idea/add")
     * @ApiDoc(
     *  resource=true,
     *  description="Add Idea",
     *  statusCodes={
     *      200="Returned when Idea was added",
     *  },
     *  parameters={
     *      {"name" = "appbundle_idea",
     *          "dataType" = "JSON",
     *          "required" = "true",
     *          "description" = "{description: ***, price: ***, category: 1/2/3, status: 0/1, author: ***}"
     *      }
     *  }
     * )
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addIdeaAction(Request $request)
    {
        $idea = new Idea();
        $form = $this->createForm(new IdeaType(), $idea);
        $this->handleJsonForm($form, $request);
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $em->persist($idea);
        $em->flush();
        return JsonResponse::create($idea, Response::HTTP_OK);
    }

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
