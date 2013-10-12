<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Saison
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="idLfp", type="integer")
     */
    private $id_lfp;


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
     * @return Saison
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
     * Set id_lfp
     *
     * @param integer $idLfp
     * @return Saison
     */
    public function setIdLfp($idLfp)
    {
        $this->id_lfp = $idLfp;
    
        return $this;
    }

    /**
     * Get id_lfp
     *
     * @return integer 
     */
    public function getIdLfp()
    {
        return $this->id_lfp;
    }
}