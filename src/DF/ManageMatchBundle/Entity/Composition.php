<?php

namespace DF\ManageMatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\ManageMatchBundle\Entity\CompositionRepository")
 */
class Composition
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
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur1;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur2;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur3;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur4;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur5;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur6;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur7;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur8;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur9;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur10;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\JoueurBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur11;


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
     * Set joueur1
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur1
     * @return Composition
     */
    public function setJoueur1(\DF\JoueurBundle\Entity\Joueur $joueur1)
    {
        $this->joueur1 = $joueur1;
    
        return $this;
    }

    /**
     * Get joueur1
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur1()
    {
        return $this->joueur1;
    }

    /**
     * Set joueur2
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur2
     * @return Composition
     */
    public function setJoueur2(\DF\JoueurBundle\Entity\Joueur $joueur2)
    {
        $this->joueur2 = $joueur2;
    
        return $this;
    }

    /**
     * Get joueur2
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur2()
    {
        return $this->joueur2;
    }

    /**
     * Set joueur3
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur3
     * @return Composition
     */
    public function setJoueur3(\DF\JoueurBundle\Entity\Joueur $joueur3)
    {
        $this->joueur3 = $joueur3;
    
        return $this;
    }

    /**
     * Get joueur3
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur3()
    {
        return $this->joueur3;
    }

    /**
     * Set joueur4
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur4
     * @return Composition
     */
    public function setJoueur4(\DF\JoueurBundle\Entity\Joueur $joueur4)
    {
        $this->joueur4 = $joueur4;
    
        return $this;
    }

    /**
     * Get joueur4
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur4()
    {
        return $this->joueur4;
    }

    /**
     * Set joueur5
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur5
     * @return Composition
     */
    public function setJoueur5(\DF\JoueurBundle\Entity\Joueur $joueur5)
    {
        $this->joueur5 = $joueur5;
    
        return $this;
    }

    /**
     * Get joueur5
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur5()
    {
        return $this->joueur5;
    }

    /**
     * Set joueur6
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur6
     * @return Composition
     */
    public function setJoueur6(\DF\JoueurBundle\Entity\Joueur $joueur6)
    {
        $this->joueur6 = $joueur6;
    
        return $this;
    }

    /**
     * Get joueur6
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur6()
    {
        return $this->joueur6;
    }

    /**
     * Set joueur7
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur7
     * @return Composition
     */
    public function setJoueur7(\DF\JoueurBundle\Entity\Joueur $joueur7)
    {
        $this->joueur7 = $joueur7;
    
        return $this;
    }

    /**
     * Get joueur7
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur7()
    {
        return $this->joueur7;
    }

    /**
     * Set joueur8
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur8
     * @return Composition
     */
    public function setJoueur8(\DF\JoueurBundle\Entity\Joueur $joueur8)
    {
        $this->joueur8 = $joueur8;
    
        return $this;
    }

    /**
     * Get joueur8
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur8()
    {
        return $this->joueur8;
    }

    /**
     * Set joueur9
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur9
     * @return Composition
     */
    public function setJoueur9(\DF\JoueurBundle\Entity\Joueur $joueur9)
    {
        $this->joueur9 = $joueur9;
    
        return $this;
    }

    /**
     * Get joueur9
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur9()
    {
        return $this->joueur9;
    }

    /**
     * Set joueur10
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur10
     * @return Composition
     */
    public function setJoueur10(\DF\JoueurBundle\Entity\Joueur $joueur10)
    {
        $this->joueur10 = $joueur10;
    
        return $this;
    }

    /**
     * Get joueur10
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur10()
    {
        return $this->joueur10;
    }

    /**
     * Set joueur11
     *
     * @param \DF\JoueurBundle\Entity\Joueur $joueur11
     * @return Composition
     */
    public function setJoueur11(\DF\JoueurBundle\Entity\Joueur $joueur11)
    {
        $this->joueur11 = $joueur11;
    
        return $this;
    }

    /**
     * Get joueur11
     *
     * @return \DF\JoueurBundle\Entity\Joueur 
     */
    public function getJoueur11()
    {
        return $this->joueur11;
    }
}