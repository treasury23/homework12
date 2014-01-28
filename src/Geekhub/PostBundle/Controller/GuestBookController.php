<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Geekhub\PostBundle\Form\Type\GuestBookType;
use Geekhub\PostBundle\Entity\GuestBook;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GuestBookController extends Controller
{
    public function localeAction($locale)
    {
        $this->get('request')->setLocale($locale);

        return $this->redirect($this->generateUrl('guestBook', array('_locale' => $locale) ));
    }

    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $post = new GuestBook();
        $form = $this->createForm(new GuestBookType(), $post);
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findAllPostDesc();

        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $posts,
            $request->query->get('page', 1),
            $this->container->getParameter('post_pagination')
        );

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('guestBook'));
            }
        }

        return array('form' => $form->createView(), 'posts' => $posts);
    }

    /**
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findOneBy(array('slug' => $slug));

        if (!$posts) {
            throw new \Exception("Post not found!");
        }

        $created = $posts->getCreated()->format('d.m.Y');

        return array('posts' => $posts, 'created' => $created);
    }

    /**
     * @Template()
     */
    public function removeAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findOneBy(array('slug' => $slug));

        if (!$posts) {
            throw new \Exception("Post not found!");
        }

        $em->remove($posts);
        $em->flush();

        return $this->redirect($this->generateUrl('guestBook'));
    }
}
