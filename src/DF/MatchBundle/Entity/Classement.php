<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\SecurityExtraBundle\Security\Util\String;

/**
 * Classement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\MatchBundle\Entity\ClassementRepository")
 */
class Classement
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
     * @var integer
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var integer
     *
     * @ORM\Column(name="journee", type="integer")
     */
    private $journee;

    /**
     * @var integer
     *
     * @ORM\Column(name="victoire", type="integer")
     */
    private $victoire;

    /**
     * @var integer
     *
     * @ORM\Column(name="nul", type="integer")
     */
    private $nul;

    /**
     * @var integer
     *
     * @ORM\Column(name="defaite", type="integer")
     */
    private $defaite;

    /**
     * @var integer
     *
     * @ORM\Column(name="but_pour", type="integer")
     */
    private $butPour;

    /**
     * @var integer
     *
     * @ORM\Column(name="but_contre", type="integer")
     */
    private $butContre;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="diff", type="integer")
     */
    private $diff;
    
    /**
     * @var String
     * 
     * @ORM\Column(name="libelle", type="string")
     */
    private $libelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id")
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
     * Set points
     *
     * @param integer $points
     * @return Classement
     */
    public function setPoints($points)
    {
        $this->points = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set journee
     *
     * @param integer $journee
     * @return Classement
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;
    
        return $this;
    }

    /**
     * Get journee
     *
     * @return integer 
     */
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * Set victoire
     *
     * @param integer $victoire
     * @return Classement
     */
    public function setVictoire($victoire)
    {
        $this->victoire = $victoire;
    
        return $this;
    }

    /**
     * Get victoire
     *
     * @return integer 
     */
    public function getVictoire()
    {
        return $this->victoire;
    }

    /**
     * Set nul
     *
     * @param integer $nul
     * @return Classement
     */
    public function setNul($nul)
    {
        $this->nul = $nul;
    
        return $this;
    }

    /**
     * Get nul
     *
     * @return integer 
     */
    public function getNul()
    {
        return $this->nul;
    }

    /**
     * Set defaite
     *
     * @param integer $defaite
     * @return Classement
     */
    public function setDefaite($defaite)
    {
        $this->defaite = $defaite;
    
        return $this;
    }

    /**
     * Get defaite
     *
     * @return integer 
     */
    public function getDefaite()
    {
        return $this->defaite;
    }

    /**
     * Set butPour
     *
     * @param integer $butPour
     * @return Classement
     */
    public function setButPour($butPour)
    {
        $this->butPour = $butPour;
    
        return $this;
    }

    /**
     * Get butPour
     *
     * @return integer 
     */
    public function getButPour()
    {
        return $this->butPour;
    }

    /**
     * Set butContre
     *
     * @param integer $butContre
     * @return Classement
     */
    public function setButContre($butContre)
    {
        $this->butContre = $butContre;
    
        return $this;
    }

    /**
     * Get butContre
     *
     * @return integer 
     */
    public function getButContre()
    {
        return $this->butContre;
    }

    /**
     * Set club
     *
     * @param \DF\EquipeBundle\Entity\Club $club
     * @return Classement
     */
    public function setClub(\DF\EquipeBundle\Entity\Club $club = null)
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
     * @return Classement
     */
    public function setSaison(\DF\MatchBundle\Entity\Saison $saison = null)
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

    /**
     * Set diff
     *
     * @param integer $diff
     * @return Classement
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;
    
        return $this;
    }

    /**
     * Get diff
     *
     * @return integer 
     */
    public function getDiff()
    {
        return $this->diff;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Classement
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
}