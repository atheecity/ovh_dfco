<?php

namespace DF\JoueurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Joueur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\JoueurBundle\Entity\JoueurRepository")
 */
class Joueur
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="datetime")
     */
    private $dateNaissance;

    /**
     * @var integer
     *
     * @ORM\Column(name="taille", type="integer", nullable=true)
     */
    private $taille;

    /**
     * @var integer
     *
     * @ORM\Column(name="poids", type="integer", nullable=true)
     */
    private $poids;
    
    /**
     * @ManyToOne(targetEntity="joueurPosition", inversedBy="joueurs")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id", nullable=true)
     */
    private $position;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="lfpJoueurUrl", type="string", length=255, nullable=true)
     */
    private $lfpJoueurUrl;


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
     * Set nom
     *
     * @param string $nom
     * @return Joueur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Joueur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Joueur
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    
        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Joueur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    
        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set taille
     *
     * @param integer $taille
     * @return Joueur
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    
        return $this;
    }

    /**
     * Get taille
     *
     * @return integer 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids
     *
     * @param integer $poids
     * @return Joueur
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    
        return $this;
    }

    /**
     * Get poids
     *
     * @return integer 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set position
     *
     * @param \DF\JoueurBundle\Entity\joueurPosition $position
     * @return Joueur
     */
    public function setPosition(\DF\JoueurBundle\Entity\joueurPosition $position = null)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return \DF\JoueurBundle\Entity\joueurPosition 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set lfpJoueurUrl
     *
     * @param string $lfpJoueurUrl
     * @return Joueur
     */
    public function setLfpJoueurUrl($lfpJoueurUrl)
    {
        $this->lfpJoueurUrl = $lfpJoueurUrl;
    
        return $this;
    }

    /**
     * Get lfpJoueurUrl
     *
     * @return string 
     */
    public function getLfpJoueurUrl()
    {
        return $this->lfpJoueurUrl;
    }
}