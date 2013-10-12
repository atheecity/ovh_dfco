<?php

namespace DF\JoueurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * JoueurClub
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\JoueurBundle\Entity\JoueurClubRepository")
 */
class JoueurClub
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
     * @ManyToOne(targetEntity="Joueur", cascade={"remove"})
     * @ORM\JoinColumn(name="joueur_id", referencedColumnName="id", nullable=false)
     */
	private $joueur;
	
	/**
	 * @ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club", cascade={"remove"})
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id", nullable=false)
	 */
	private $club; 
	
	/**
	 * @ManyToOne(targetEntity="DF\MatchBundle\Entity\Saison", cascade={"remove"})
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id", nullable=false)
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
     * Set joueur
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur
     * @return JoueurClub
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
     * Set club
     *
     * @param \DF\EquipeBundle\Entity\Club $club
     * @return JoueurClub
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
     * Set saison
     *
     * @param \DF\MatchBundle\Entity\Saison $saison
     * @return JoueurClub
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