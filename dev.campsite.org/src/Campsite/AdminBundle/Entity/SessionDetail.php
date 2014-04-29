<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\SessionDetail
 *
 * @ORM\Table(name="session_detail")
 * @ORM\Entity
 */
class SessionDetail
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string $contentType
     *
     * @ORM\Column(name="content_type", type="string", length=255, nullable=false)
     */
    private $contentType;
	
	/**
     * @var string $contentTitle
     *
     * @ORM\Column(name="content_title", type="string", length=255, nullable=false)
     */
    private $contentTitle;

    /**
     * @var string $contentDescription
     *
     * @ORM\Column(name="content_description", type="text", nullable=false)
     */
    private $contentDescription;

    /**
     * @var string $contentWrittenby
     *
     * @ORM\Column(name="content_writtenby", type="string", length=255, nullable=false)
     */
    private $contentWrittenby;

    /**
     * @var \DateTime $createdat
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime $updatedat
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedat;

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
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     * })
     */
    private $session;



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
     * Set title
     *
     * @param string $title
     * @return SessionDetail
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
     * Set contentTitle
     *
     * @param string $contentTitle
     * @return SessionDetail
     */
    public function setContentTitle($contentTitle)
    {
        $this->contentTitle = $contentTitle;
    
        return $this;
    }

    /**
     * Get contentTitle
     *
     * @return string 
     */
    public function getContentTitle()
    {
        return $this->contentTitle;
    }
	
    /**
     * Set contentType
     *
     * @param string $contentType
     * @return SessionDetail
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    
        return $this;
    }

    /**
     * Get contentType
     *
     * @return string 
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set contentDescription
     *
     * @param string $contentDescription
     * @return SessionDetail
     */
    public function setContentDescription($contentDescription)
    {
        $this->contentDescription = $contentDescription;
    
        return $this;
    }

    /**
     * Get contentDescription
     *
     * @return string 
     */
    public function getContentDescription()
    {
        return $this->contentDescription;
    }

    /**
     * Set contentWrittenby
     *
     * @param string $contentWrittenby
     * @return SessionDetail
     */
    public function setContentWrittenby($contentWrittenby)
    {
        $this->contentWrittenby = $contentWrittenby;
    
        return $this;
    }

    /**
     * Get contentWrittenby
     *
     * @return string 
     */
    public function getContentWrittenby()
    {
        return $this->contentWrittenby;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     * @return SessionDetail
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    
        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime 
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     * @return SessionDetail
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
    
        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime 
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set fosuser
     *
     * @param Campsite\AdminBundle\Entity\FosUser $fosuser
     * @return SessionDetail
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
     * Set session
     *
     * @param Campsite\AdminBundle\Entity\Session $session
     * @return SessionDetail
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
}