<?php

namespace Geekhub\PostBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class GuestBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('name');
        $builder->add('email');
        $builder->add('message');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'guestbook';
    }
}