<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
//        return $this->render('default/index.html.twig');
        return $this->redirect($this->generateUrl('idea'));
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
            . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
            . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
            . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
        $data = base64_decode($data);

        $im = imagecreatefromstring($data);
        if ($im !== false) {
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/test/';
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }
            imagepng($im, 'test.png',9);
            imagedestroy($im);
        }

        return $this->render('default/index.html.twig');

    }
}
