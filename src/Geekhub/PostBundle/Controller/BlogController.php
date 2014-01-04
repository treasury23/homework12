<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Geekhub\PostBundle\Entity\About;

class BlogController extends Controller
{
    public function homeAction()
    {
        return $this->render('GeekhubPostBundle:Blog:blog.html.twig');
    }

    public function aboutAction()
    {
        $item = $this->getDoctrine()->getRepository('GeekhubPostBundle:About');

        if (!$item) {
            throw new \Exception("Product not found!");
        }

        return $this->render('GeekhubPostBundle:Blog:about.html.twig', array('items' => $item->findAll()));
    }
}

