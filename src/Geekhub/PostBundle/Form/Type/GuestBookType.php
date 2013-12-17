<?php

namespace Geekhub\PostBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class GuestBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('name', 'text');
        $builder->add('email', 'email');
        $builder->add('body', 'textarea');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'GuestBook';
    }
}