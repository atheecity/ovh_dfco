<?php

namespace DF\EquipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubEntraineur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\EquipeBundle\Entity\ClubEntraineurRepository")
 */
class ClubEntraineur
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
     */
    private $club;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Entraineur")
     */
    private $entraineur;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\MatchBundle\Entity\Saison")
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
     * @return ClubEntraineur
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
     * Set entraineur
     *
     * @param \DF\EquipeBundle\Entity\Entraineur $entraineur
     * @return ClubEntraineur
     */
    public function setEntraineur(\DF\EquipeBundle\Entity\Entraineur $entraineur = null)
    {
        $this->entraineur = $entraineur;
    
        return $this;
    }

    /**
     * Get entraineur
     *
     * @return \DF\EquipeBundle\Entity\Entraineur 
     */
    public function getEntraineur()
    {
        return $this->entraineur;
    }

    /**
     * Set saison
     *
     * @param \DF\MatchBundle\Entity\Saison $saison
     * @return ClubEntraineur
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
}