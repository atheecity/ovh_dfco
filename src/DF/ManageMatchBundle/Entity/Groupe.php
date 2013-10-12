<?php

namespace DF\ManageMatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\ManageMatchBundle\Entity\GroupeRepository")
 */
class Groupe
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
     * @ORM\ManyToMany(targetEntity="DF\JoueurBundle\Entity\Joueur", cascade={"persist"})
     */
    private $joueurs;


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
     * Constructor
     */
    public function __construct()
    {
        $this->joueurs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add joueurs
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueurs
     * @return Groupe
     */
    public function addJoueur(\DF\JoueurBundle\Entity\Joueur $joueurs)
    {
        $this->joueurs[] = $joueurs;
    
        return $this;
    }

    /**
     * Remove joueurs
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueurs
     */
    public function removeJoueur(\DF\JoueurBundle\Entity\Joueur $joueurs)
    {
        $this->joueurs->removeElement($joueurs);
    }

    /**
     * Get joueurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }
}