<?php

namespace DF\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\MatchBundle\Entity\MatchsRepository")
 */
class Matchs
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club")
     * @ORM\JoinColumn(name="equipeDom", nullable=false)
     */
    private $equipeDom;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\EquipeBundle\Entity\Club")
     * @ORM\JoinColumn(name="equipeExt", nullable=false)
     */
    private $equipeExt;
    
    /**
     * @ORM\OneToOne(targetEntity="DF\ManageMatchBundle\Entity\FeuilleMatch")
     * @ORM\JoinColumn(nullable=true)
     */
    private $feuilleMatch;
    
    /**
     * @ORM\OneToOne(targetEntity="DF\ManageMatchBundle\Entity\Groupe")
     */
    private $groupeDom;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\StadeBundle\Entity\Stade")
     * @ORM\JoinColumn(nullable=true)
     */
    private $stade;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\MatchBundle\Entity\Calendrier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $calendrier;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_dom", type="integer", nullable=true)
     */
    private $scoreDom;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_ext", type="integer", nullable=true)
     */
    private $scoreExt;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_dom_tab", type="integer", nullable=true)
     */
    private $scoreDomTab;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_ext_tab", type="integer", nullable=true)
     */
    private $scoreExtTab;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prolongation", type="boolean", nullable=true)
     */
    private $prolongation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="report", type="boolean", nullable=true)
     */
    private $report;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_report", type="datetime", nullable=true)
     */
    private $dateReport;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Matchs
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set scoreDom
     *
     * @param integer $scoreDom
     * @return Matchs
     */
    public function setScoreDom($scoreDom)
    {
        $this->scoreDom = $scoreDom;
    
        return $this;
    }

    /**
     * Get scoreDom
     *
     * @return integer 
     */
    public function getScoreDom()
    {
        return $this->scoreDom;
    }

    /**
     * Set scoreExt
     *
     * @param integer $scoreExt
     * @return Matchs
     */
    public function setScoreExt($scoreExt)
    {
        $this->scoreExt = $scoreExt;
    
        return $this;
    }

    /**
     * Get scoreExt
     *
     * @return integer 
     */
    public function getScoreExt()
    {
        return $this->scoreExt;
    }

    /**
     * Set scoreDomTab
     *
     * @param integer $scoreDomTab
     * @return Matchs
     */
    public function setScoreDomTab($scoreDomTab)
    {
        $this->scoreDomTab = $scoreDomTab;
    
        return $this;
    }

    /**
     * Get scoreDomTab
     *
     * @return integer 
     */
    public function getScoreDomTab()
    {
        return $this->scoreDomTab;
    }

    /**
     * Set scoreExtTab
     *
     * @param integer $scoreExtTab
     * @return Matchs
     */
    public function setScoreExtTab($scoreExtTab)
    {
        $this->scoreExtTab = $scoreExtTab;
    
        return $this;
    }

    /**
     * Get scoreExtTab
     *
     * @return integer 
     */
    public function getScoreExtTab()
    {
        return $this->scoreExtTab;
    }

    /**
     * Set prolongation
     *
     * @param boolean $prolongation
     * @return Matchs
     */
    public function setProlongation($prolongation)
    {
        $this->prolongation = $prolongation;
    
        return $this;
    }

    /**
     * Get prolongation
     *
     * @return boolean 
     */
    public function getProlongation()
    {
        return $this->prolongation;
    }

    /**
     * Set report
     *
     * @param boolean $report
     * @return Matchs
     */
    public function setReport($report)
    {
        $this->report = $report;
    
        return $this;
    }

    /**
     * Get report
     *
     * @return boolean 
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set dateReport
     *
     * @param \DateTime $dateReport
     * @return Matchs
     */
    public function setDateReport($dateReport)
    {
        $this->dateReport = $dateReport;
    
        return $this;
    }

    /**
     * Get dateReport
     *
     * @return \DateTime 
     */
    public function getDateReport()
    {
        return $this->dateReport;
    }

    /**
     * Set equipeDom
     *
     * @param \DF\EquipeBundle\Entity\Club $equipeDom
     * @return Matchs
     */
    public function setEquipeDom(\DF\EquipeBundle\Entity\Club $equipeDom)
    {
        $this->equipeDom = $equipeDom;
    
        return $this;
    }

    /**
     * Get equipeDom
     *
     * @return \DF\EquipeBundle\Entity\Club 
     */
    public function getEquipeDom()
    {
        return $this->equipeDom;
    }

    /**
     * Set equipeExt
     *
     * @param \DF\EquipeBundle\Entity\Club $equipeExt
     * @return Matchs
     */
    public function setEquipeExt(\DF\EquipeBundle\Entity\Club $equipeExt)
    {
        $this->equipeExt = $equipeExt;
    
        return $this;
    }

    /**
     * Get equipeExt
     *
     * @return \DF\EquipeBundle\Entity\Club 
     */
    public function getEquipeExt()
    {
        return $this->equipeExt;
    }

    /**
     * Set stade
     *
     * @param \DF\StadeBundle\Entity\Stade $stade
     * @return Matchs
     */
    public function setStade(\DF\StadeBundle\Entity\Stade $stade)
    {
        $this->stade = $stade;
    
        return $this;
    }

    /**
     * Get stade
     *
     * @return \DF\StadeBundle\Entity\Stade 
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * Set calendrier
     *
     * @param \DF\MatchBundle\Entity\Calendrier $calendrier
     * @return Matchs
     */
    public function setCalendrier(\DF\MatchBundle\Entity\Calendrier $calendrier)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return \DF\MatchBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }

    /**
     * Set feuilleMatch
     *
     * @param \DF\ManageMatchBundle\Entity\FeuilleMatch $feuilleMatch
     * @return Matchs
     */
    public function setFeuilleMatch(\DF\ManageMatchBundle\Entity\FeuilleMatch $feuilleMatch = null)
    {
        $this->feuilleMatch = $feuilleMatch;
    
        return $this;
    }

    /**
     * Get feuilleMatch
     *
     * @return \DF\ManageMatchBundle\Entity\FeuilleMatch 
     */
    public function getFeuilleMatch()
    {
        return $this->feuilleMatch;
    }

    /**
     * Set groupeDom
     *
     * @param \DF\ManageMatchBundle\Entity\Groupe $groupeDom
     * @return Matchs
     */
    public function setGroupeDom(\DF\ManageMatchBundle\Entity\Groupe $groupeDom = null)
    {
        $this->groupeDom = $groupeDom;
    
        return $this;
    }

    /**
     * Get groupeDom
     *
     * @return \DF\ManageMatchBundle\Entity\Groupe 
     */
    public function getGroupeDom()
    {
        return $this->groupeDom;
    }
}