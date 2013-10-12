<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carton
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\MatchBundle\Entity\CartonRepository")
 */
class Carton
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
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="minute", type="integer")
     */
    private $minute;


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
     * Set type
     *
     * @param integer $type
     * @return Carton
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set minute
     *
     * @param integer $minute
     * @return Carton
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
     * Set match
     *
     * @param \DF\MatchBundle\Entity\Matchs $match
     * @return Carton
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
     * Set club
     *
     * @param \DF\EquipeBundle\Entity\Club $club
     * @return Carton
     */
    public function setClub(\DF\EquipeBundle\Entity\Club $club)
    {
        $this->club = $club;
    
        return $this;
    }

    /**
     * Get club
     *
     * @return \DF\EquipeBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set joueur
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur
     * @return Carton
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
}