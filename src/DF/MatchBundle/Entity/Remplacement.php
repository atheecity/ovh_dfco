<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Remplacement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\MatchBundle\Entity\RemplacementRepository")
 */
class Remplacement
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
    private $joueurEntrant;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueurSortant;

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
     * Set minute
     *
     * @param integer $minute
     * @return Remplacement
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
     * @return Remplacement
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
     * @return Remplacement
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
     * Set joueurEntrant
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueurEntrant
     * @return Remplacement
     */
    public function setJoueurEntrant(\DF\JoueurBundle\Entity\Joueur $joueurEntrant)
    {
        $this->joueurEntrant = $joueurEntrant;
    
        return $this;
    }

    /**
     * Get joueurEntrant
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueurEntrant()
    {
        return $this->joueurEntrant;
    }

    /**
     * Set joueurSortant
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueurSortant
     * @return Remplacement
     */
    public function setJoueurSortant(\DF\JoueurBundle\Entity\Joueur $joueurSortant)
    {
        $this->joueurSortant = $joueurSortant;
    
        return $this;
    }

    /**
     * Get joueurSortant
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueurSortant()
    {
        return $this->joueurSortant;
    }
}