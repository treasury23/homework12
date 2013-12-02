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
        $guestbook = new GuestBook();

        $form = $this->createForm(new GuestBookType(), $guestbook);

        return $this->render('GeekhubPostBundle:GuestBook:index.html.twig', array('form' => $form->createView(), 'posts' => 1));
    }
}
