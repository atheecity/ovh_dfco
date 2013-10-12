<?php

namespace DF\EquipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\EquipeBundle\Entity\ClubRepository")
 */
class Club
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
     * @ORM\Column(name="nom_complet", type="string", length=255, nullable=true)
     */
    private $nomComplet;

    /**
     * @var string
     *
     * @ORM\Column(name="acronyme", type="string", length=255)
     */
    private $acronyme;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="lfp_libelle", type="string", length=255, nullable=true)
     */
    private $lfpLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

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
     * @return Club
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
     * Set nomComplet
     *
     * @param string $nomComplet
     * @return Club
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;
    
        return $this;
    }

    /**
     * Get nomComplet
     *
     * @return string 
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * Set acronyme
     *
     * @param string $acronyme
     * @return Club
     */
    public function setAcronyme($acronyme)
    {
        $this->acronyme = $acronyme;
    
        return $this;
    }

    /**
     * Get acronyme
     *
     * @return string 
     */
    public function getAcronyme()
    {
        return $this->acronyme;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Club
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set lfpLibelle
     *
     * @param string $lfpLibelle
     * @return Club
     */
    public function setLfpLibelle($lfpLibelle)
    {
        $this->lfpLibelle = $lfpLibelle;
    
        return $this;
    }

    /**
     * Get lfpLibelle
     *
     * @return string 
     */
    public function getLfpLibelle()
    {
        return $this->lfpLibelle;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Club
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
