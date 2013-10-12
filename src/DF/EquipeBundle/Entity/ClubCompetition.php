<?php

namespace DF\EquipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * club_competition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\EquipeBundle\Entity\ClubCompetitionRepository")
 */
class ClubCompetition
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
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\MatchBundle\Entity\Competition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\MatchBundle\Entity\Saison")
     * @ORM\JoinColumn(nullable=false)
     */
    private $saison;


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
     * Set club
     *
     * @param \DF\EquipeBundle\Entity\Club $club
     * @return club_competition
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
     * Set competition
     *
     * @param \DF\MatchBundle\Entity\Competition $competition
     * @return club_competition
     */
    public function setCompetition(\DF\MatchBundle\Entity\Competition $competition)
    {
        $this->competition = $competition;
    
        return $this;
    }

    /**
     * Get competition
     *
     * @return \DF\MatchBundle\Entity\Competition 
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set saison
     *
     * @param \DF\MatchBundle\Entity\Saison $saison
     * @return club_competition
     */
    public function setSaison(\DF\MatchBundle\Entity\Saison $saison)
    {
        $this->saison = $saison;
    
        return $this;
    }

    /**
     * Get saison
     *
     * @return \DF\MatchBundle\Entity\Saison 
     */
    public function getSaison()
    {
        return $this->saison;
    }
}