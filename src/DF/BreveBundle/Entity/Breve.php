<?php

namespace DF\BreveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Breve
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\BreveBundle\Entity\BreveRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Breve
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="illustration", type="string", length=255)
     */
    private $illustration;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="datePublication", type="datetime", nullable=true)
     */
    private $datePublication;
    
    /**
     * @var \DF\UserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="DF\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="isPublish", type="boolean")
     */
    private $isPublish = false;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="isPublishSlide", type="boolean")
     */
    private $isPublishSlide = false;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\BreveBundle\Entity\Categorie", cascade={"persist"})
     */
    private $categorie;

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
     * @return Breve
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
     * Set content
     *
     * @param string $content
     * @return Breve
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param \DF\UserBundle\Entity\User $author
     * @return Breve
     */
    public function setAuthor(\DF\UserBundle\Entity\User $author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \DF\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Breve
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set isPublish
     *
     * @param boolean $isPublish
     * @return Breve
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;
    
        return $this;
    }

    /**
     * Get isPublish
     *
     * @return boolean 
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Breve
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set illustration
     *
     * @param string $illustration
     * @return Breve
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    
        return $this;
    }

    /**
     * Get illustration
     *
     * @return string 
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    /**
     * Set isPublishSlide
     *
     * @param boolean $isPublishSlide
     * @return Breve
     */
    public function setIsPublishSlide($isPublishSlide)
    {
        $this->isPublishSlide = $isPublishSlide;
    
        return $this;
    }

    /**
     * Get isPublishSlide
     *
     * @return boolean 
     */
    public function getIsPublishSlide()
    {
        return $this->isPublishSlide;
    }

    /**
     * Set categorie
     *
     * @param \DF\BreveBundle\Entity\Categorie $categorie
     * @return Breve
     */
    public function setCategorie(\DF\BreveBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \DF\BreveBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}