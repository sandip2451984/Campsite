<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\UserTopicVote
 *
 * @ORM\Table(name="user_topic_vote")
 * @ORM\Entity
 */
class UserTopicVote
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     * })
     */
    private $session;

    /**
     * @var FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fosuser_id", referencedColumnName="id")
     * })
     */
    private $fosuser;

    /**
     * @var integer $vote
     *
     * @ORM\Column(name="vote", type="integer", nullable=true)
     */
    private $vote;

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
     * Set session
     *
     * @param Campsite\AdminBundle\Entity\Session $session
     * @return UserTopicVote
     */
    public function setSession(\Campsite\AdminBundle\Entity\Session $session = null)
    {
        $this->session = $session;
    
        return $this;
    }

    /**
     * Get session
     *
     * @return Campsite\AdminBundle\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set fosuser
     *
     * @param Campsite\AdminBundle\Entity\FosUser $fosuser
     * @return UserTopicVote
     */
    public function setFosuser(\Campsite\AdminBundle\Entity\FosUser $fosuser = null)
    {
        $this->fosuser = $fosuser;
    
        return $this;
    }

    /**
     * Get fosuser
     *
     * @return Campsite\AdminBundle\Entity\FosUser 
     */
    public function getFosuser()
    {
        return $this->fosuser;
    }
	
	/**
     * Set vote
     *
     * @param integer $vote
     * @return UserTopicVote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    
        return $this;
    }

    /**
     * Get vote
     *
     * @return integer 
     */
    public function getVote()
    {
        return $this->vote;
    }
}