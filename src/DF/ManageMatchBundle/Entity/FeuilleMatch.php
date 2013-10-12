<?php

namespace DF\ManageMatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeuilleMatch
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\ManageMatchBundle\Entity\FeuilleMatchRepository")
 */
class FeuilleMatch
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
     * @ORM\OneToOne(targetEntity="DF\ManageMatchBundle\Entity\Composition", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $compositionDom;
    
    /**
     * @ORM\OneToOne(targetEntity="DF\ManageMatchBundle\Entity\Composition", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $compositionExt;


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
     * Set compositionDom
     *
     * @param \DF\ManageMatchBundle\Entity\Composition $compositionDom
     * @return FeuilleMatch
     */
    public function setCompositionDom(\DF\ManageMatchBundle\Entity\Composition $compositionDom)
    {
        $this->compositionDom = $compositionDom;
    
        return $this;
    }

    /**
     * Get compositionDom
     *
     * @return \DF\ManageMatchBundle\Entity\Composition 
     */
    public function getCompositionDom()
    {
        return $this->compositionDom;
    }

    /**
     * Set compositionExt
     *
     * @param \DF\ManageMatchBundle\Entity\Composition $compositionExt
     * @return FeuilleMatch
     */
    public function setCompositionExt(\DF\ManageMatchBundle\Entity\Composition $compositionExt)
    {
        $this->compositionExt = $compositionExt;
    
        return $this;
    }

    /**
     * Get compositionExt
     *
     * @return \DF\ManageMatchBundle\Entity\Composition 
     */
    public function getCompositionExt()
    {
        return $this->compositionExt;
    }
}