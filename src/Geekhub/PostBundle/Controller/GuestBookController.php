<?php

namespace Geekhub\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Geekhub\PostBundle\Form\Type\GuestBookType;
use Geekhub\PostBundle\Entity\GuestBook;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GuestBookController extends Controller
{

    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $post = new GuestBook();
        $form = $this->createForm(new GuestBookType(), $post);
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('GeekhubPostBundle:GuestBook')->findAll();

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
}
