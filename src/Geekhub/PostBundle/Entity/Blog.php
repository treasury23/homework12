<?php

namespace Geekhub\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="BlogPost")
 *
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string title
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @var string description
     */
    protected $description;

    /** @OneToMany(targetEntity="Image", mappedBy="film", cascade={"remove"}) */
    protected $image;

}
