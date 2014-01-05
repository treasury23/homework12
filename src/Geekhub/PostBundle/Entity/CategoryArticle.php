<?php

namespace Geekhub\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class CategoryArticle
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="categoryArticle")
     */
    protected $article;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return CategoryArticle
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add article
     *
     * @param \Geekhub\PostBundle\Entity\Blog $article
     * @return CategoryArticle
     */
    public function addArticle(\Geekhub\PostBundle\Entity\Blog $article)
    {
        $this->article[] = $article;
    
        return $this;
    }

    /**
     * Remove article
     *
     * @param \Geekhub\PostBundle\Entity\Blog $article
     */
    public function removeArticle(\Geekhub\PostBundle\Entity\Blog $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticle()
    {
        return $this->article;
    }
}