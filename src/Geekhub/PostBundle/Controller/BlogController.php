<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Geekhub\PostBundle\Entity\About;
use Geekhub\PostBundle\Entity\GuestBook;

class BlogController extends Controller
{
    public function homeAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blogHome"));

        $articles = $this->getDoctrine()->getRepository('GeekhubPostBundle:Blog')->findAll();

        $paginator_blog = $this->get('knp_paginator');
        $articles = $paginator_blog->paginate(
            $articles,
            $request->query->get('page', 1),
            $this->container->getParameter('post_pagination')
        );

        return $this->render('GeekhubPostBundle:Blog:blog.html.twig', array('articles' => $articles,
                                                                            'last_articles' =>$this->lastArticles(),
                                                                            'viewedArticles' =>$this->viewedArticles(),
                                                                            'last_posts' =>$this->lastPosts(),
                                                                            'tags' =>$this->tagCloud()));
    }

    public function aboutAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->get("router")->generate("blogHome"));
        $breadcrumbs->addItem("About me", $this->get("router")->generate("blogAbout"));

        $item = $this->getDoctrine()->getRepository('GeekhubPostBundle:About');

        return $this->render('GeekhubPostBundle:Blog:about.html.twig', array('items' => $item->findAll(),
                                                                            'last_articles' =>$this->lastArticles(),
                                                                            'viewedArticles' =>$this->viewedArticles(),
                                                                            'last_posts' =>$this->lastPosts(),
                                                                            'tags' =>$this->tagCloud()));
    }

    public function articleAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('GeekhubPostBundle:Blog')->findOneBy(array('slug' => $slug));

        if (!$article) {
            throw new \Exception("Post not found!");
        }

        $article->setViewed($article->getViewed()+1);
        $em->flush();

        return $this->render('GeekhubPostBundle:Blog:article.html.twig', array('article' => $article,
                                                                                'last_articles' =>$this->lastArticles(),
                                                                                'viewedArticles' =>$this->viewedArticles(),
                                                                                'last_posts' =>$this->lastPosts(),
                                                                                'tags' =>$this->tagCloud()));
    }

    public function lastArticles()
    {
        $em = $this->getDoctrine()->getManager();

        return $lastArticles = $em->getRepository('GeekhubPostBundle:Blog')->findLastArticle();
    }

    public function viewedArticles()
    {
        $em = $this->getDoctrine()->getManager();

        return $viewedArticles = $em->getRepository('GeekhubPostBundle:Blog')->findViewedArticle();
    }

    public function lastPosts()
    {
        $em = $this->getDoctrine()->getManager();

        return $last_posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findLastPost();
    }

    public function tagCloud()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('GeekhubPostBundle:Tag')->getTags();

        return $tagWeights = $em->getRepository('GeekhubPostBundle:Tag')->getTagWeights($tags);
    }
}

