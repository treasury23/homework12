<?php

namespace Geekhub\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class Image {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer $id
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @var string path
     */

    protected $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string originalPath
     */

    protected $originalPath;

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
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set originalPath
     *
     * @param string $originalPath
     * @return Image
     */
    public function setOriginalPath($originalPath)
    {
        $this->originalPath = $originalPath;
    
        return $this;
    }

    /**
     * Get originalPath
     *
     * @return string 
     */
    public function getOriginalPath()
    {
        return $this->originalPath;
    }
}