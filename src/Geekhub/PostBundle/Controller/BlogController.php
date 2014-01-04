<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function homeAction()
    {
        return $this->render('GeekhubPostBundle:Blog:blog.html.twig');
    }
}