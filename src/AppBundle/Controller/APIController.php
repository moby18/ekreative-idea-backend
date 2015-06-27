<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Idea;
use AppBundle\Form\CommentType;
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
     * @Route("/api/idea/{id}/comment/list")
     * @ApiDoc(
     *  resource=true,
     *  description="Get Idea Comments list",
     *  statusCodes={
     *      200="Returned Ideas Comments list"
     *  }
     * )
     * @ParamConverter("idea", class="AppBundle:Idea")
     * @Method("GET")
     * @param Idea $idea
     * @return JsonResponse
     */
    public function getIdeaCommentListAction(Idea $idea)
    {
        // TODO why it doesnt work
//        $items = $idea->getComments();
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Comment')->findBy(['idea' => $idea->getId()]);
        return JsonResponse::create($items, Response::HTTP_OK);
    }

    /**
     * @Route("/api/idea/{id}/comment/add")
     * @ApiDoc(
     *  resource=true,
     *  description="Add Idea Comment",
     *  statusCodes={
     *      200="Returned when Comment was added"
     *  }
     * )
     * @ParamConverter("idea", class="AppBundle:Idea")
     * @Method("POST")
     * @param Request $request
     * @param Idea $idea
     * @return JsonResponse
     */
    public function addIdeaCommentListAction(Request $request, Idea $idea)
    {
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);
        $this->handleJsonForm($form, $request);
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
//        $idea->addComment($comment);
        $em->flush();
        return JsonResponse::create($comment, Response::HTTP_OK);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="add Idea like",
     *  statusCodes={
     *      200="Returned when Idea was liked",
     *  }
     * )
     * @Route("/api/idea/{id}/like")
     * @ParamConverter("idea", class="AppBundle:Idea")
     * @Method("POST")
     * @param Idea $idea
     * @return JsonResponse
     */
    public function addIdeaLikeAction(Idea $idea)
    {
        $idea->setLikes($idea->getLikes()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return JsonResponse::create($idea, Response::HTTP_OK);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="add Idea dislike",
     *  statusCodes={
     *      200="Returned when Idea was disliked",
     *  }
     * )
     * @Route("/api/idea/{id}/dislike")
     * @ParamConverter("idea", class="AppBundle:Idea")
     * @Method("POST")
     * @param Idea $idea
     * @return JsonResponse
     */
    public function addIdeaDislikeAction(Idea $idea)
    {
        $idea->setDislikes($idea->getDislikes()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return JsonResponse::create($idea, Response::HTTP_OK);
    }

}
