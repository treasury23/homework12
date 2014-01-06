<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Geekhub\PostBundle\Entity\About;
use Geekhub\PostBundle\Entity\GuestBook;

class BlogController extends Controller
{
    public function homeAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blogHome"));

        $articles = $this->getDoctrine()->getRepository('GeekhubPostBundle:Blog');

        if (!$articles) {
            throw new \Exception("Product not found!");
        }

        $em = $this->getDoctrine()->getManager();
        $last_articles = $em->getRepository('GeekhubPostBundle:Blog')->findLastArticle();
        $last_posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findLastPost();

        $tags = $em->getRepository('GeekhubPostBundle:Tag')->getTags();
        $tagWeights = $em->getRepository('GeekhubPostBundle:Tag')->getTagWeights($tags);

        return $this->render('GeekhubPostBundle:Blog:blog.html.twig', array('articles' => $articles->findAll(),
                                                                             'last_articles' => $last_articles,
                                                                                'last_posts' => $last_posts,
                                                                                    'tags' => $tagWeights));
    }

    public function aboutAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blogHome"));
        $breadcrumbs->addItem("About me", $this->get("router")->generate("blogAbout"));

        $item = $this->getDoctrine()->getRepository('GeekhubPostBundle:About');

        if (!$item) {
            throw new \Exception("Product not found!");
        }

        $em = $this->getDoctrine()->getManager();
        $last_articles = $em->getRepository('GeekhubPostBundle:Blog')->findLastArticle();
        $last_posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findLastPost();

        $tags = $em->getRepository('GeekhubPostBundle:Tag')->getTags();
        $tagWeights = $em->getRepository('GeekhubPostBundle:Tag')->getTagWeights($tags);

        return $this->render('GeekhubPostBundle:Blog:about.html.twig', array('items' => $item->findAll(),
                                                                                'last_articles' => $last_articles,
                                                                                'last_posts' => $last_posts,
                                                                                'tags' => $tagWeights));
    }
}

