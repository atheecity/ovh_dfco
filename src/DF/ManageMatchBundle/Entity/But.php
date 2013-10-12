<?php

namespace DF\ManageMatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * But
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\ManageMatchBundle\Entity\ButRepository")
 */
class But
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
     * @ORM\ManyToOne(targetEntity="DF\MatchBundle\Entity\Matchs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $passeur;

    /**
     * @var integer
     *
     * @ORM\Column(name="minute", type="integer")
     */
    private $minute;

    /**
     * @var boolean
     *
     * @ORM\Column(name="csc", type="boolean")
     */
    private $csc;


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
     * Set minute
     *
     * @param integer $minute
     * @return But
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    
        return $this;
    }

    /**
     * Get minute
     *
     * @return integer 
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set csc
     *
     * @param boolean $csc
     * @return But
     */
    public function setCsc($csc)
    {
        $this->csc = $csc;
    
        return $this;
    }

    /**
     * Get csc
     *
     * @return boolean 
     */
    public function getCsc()
    {
        return $this->csc;
    }

    /**
     * Set match
     *
     * @param \DF\MatchBundle\Entity\Matchs $match
     * @return But
     */
    public function setMatch(\DF\MatchBundle\Entity\Matchs $match)
    {
        $this->match = $match;
    
        return $this;
    }

    /**
     * Get match
     *
     * @return \DF\MatchBundle\Entity\Matchs 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set equipe
     *
     * @param \DF\EquipeBundle\Entity\Club $equipe
     * @return But
     */
    public function setEquipe(\DF\EquipeBundle\Entity\Club $equipe)
    {
        $this->equipe = $equipe;
    
        return $this;
    }

    /**
     * Get equipe
     *
     * @return \DF\EquipeBundle\Entity\Club 
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set joueur
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur
     * @return But
     */
    public function setJoueur(\DF\JoueurBundle\Entity\Joueur $joueur)
    {
        $this->joueur = $joueur;
    
        return $this;
    }

    /**
     * Get joueur
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Set passeur
     *
     * @param \DF\JoueurBundle\Entity\Joueur $passeur
     * @return But
     */
    public function setPasseur(\DF\JoueurBundle\Entity\Joueur $passeur = null)
    {
        $this->passeur = $passeur;
    
        return $this;
    }

    /**
     * Get passeur
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getPasseur()
    {
        return $this->passeur;
    }
}