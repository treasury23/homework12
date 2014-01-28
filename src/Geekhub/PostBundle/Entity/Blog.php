<?php

namespace Geekhub\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="Geekhub\PostBundle\Repository\BlogRepository")
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

    /**
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id",onDelete="SET NULL")
     *
     **/
    protected  $image;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryArticle", inversedBy="blog")
     * @ORM\JoinColumn(name="category_article_id", referencedColumnName="id")
     */
    protected $categoryArticle;

    /**
     * @var date $created
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected  $created;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=150, unique=true)
     */
    protected  $slug;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="blogs")
     * @ORM\JoinTable(name="blog_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *   }
     * )
     */
    protected  $tags;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $viewed;

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
     * @return Blog
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
     * Set description
     *
     * @param string $description
     * @return Blog
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Blog
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Blog
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param \Geekhub\PostBundle\Entity\Image $image
     * @return Blog
     */
    public function setImage(\Geekhub\PostBundle\Entity\Image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Geekhub\PostBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categoryArticle
     *
     * @param \Geekhub\PostBundle\Entity\CategoryArticle $categoryArticle
     * @return Blog
     */
    public function setCategoryArticle(\Geekhub\PostBundle\Entity\CategoryArticle $categoryArticle = null)
    {
        $this->categoryArticle = $categoryArticle;
    
        return $this;
    }

    /**
     * Get categoryArticle
     *
     * @return \Geekhub\PostBundle\Entity\CategoryArticle 
     */
    public function getCategoryArticle()
    {
        return $this->categoryArticle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add tags
     *
     * @param \Geekhub\PostBundle\Entity\Tag $tags
     * @return Blog
     */
    public function addTag(\Geekhub\PostBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Geekhub\PostBundle\Entity\Tag $tags
     */
    public function removeTag(\Geekhub\PostBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Set viewed
     *
     * @param integer $viewed
     * @return Blog
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
    
        return $this;
    }

    /**
     * Get viewed
     *
     * @return integer 
     */
    public function getViewed()
    {
        return $this->viewed;
    }
}