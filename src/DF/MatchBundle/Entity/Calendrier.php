<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendrier
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Calendrier
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_court", type="string", length=255, nullable=true)
     */
    private $libelleCourt;
    
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
     * Set libelle
     *
     * @param string $libelle
     * @return Calendrier
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set libelleCourt
     *
     * @param string $libelleCourt
     * @return Calendrier
     */
    public function setLibelleCourt($libelleCourt)
    {
        $this->libelleCourt = $libelleCourt;
    
        return $this;
    }

    /**
     * Get libelleCourt
     *
     * @return string 
     */
    public function getLibelleCourt()
    {
        return $this->libelleCourt;
    }

    /**
     * Set competition
     *
     * @param \DF\MatchBundle\Entity\Competition $competition
     * @return Calendrier
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
     * @return Calendrier
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