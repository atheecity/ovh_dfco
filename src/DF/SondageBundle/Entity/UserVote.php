<?php

namespace DF\SondageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserVote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DF\SondageBundle\Entity\UserVoteRepository")
 */
class UserVote
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
     * @ORM\ManyToOne(targetEntity="DF\UserBundle\Entity\User")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\SondageBundle\Entity\Question")
     */
    private $question;
    
    /**
     * @ORM\ManyToOne(targetEntity="DF\SondageBundle\Entity\Reponse")
     */
    private $reponse;


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
     * Set user
     *
     * @param \DF\UserBundle\Entity\User $user
     * @return UserVote
     */
    public function setUser(\DF\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \DF\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set question
     *
     * @param \DF\SondageBundle\Entity\Question $question
     * @return UserVote
     */
    public function setQuestion(\DF\SondageBundle\Entity\Question $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \DF\SondageBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set reponse
     *
     * @param \DF\SondageBundle\Entity\Reponse $reponse
     * @return UserVote
     */
    public function setReponse(\DF\SondageBundle\Entity\Reponse $reponse = null)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return \DF\SondageBundle\Entity\Reponse 
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}