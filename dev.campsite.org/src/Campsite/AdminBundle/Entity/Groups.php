<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\Groups
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="Campsite\AdminBundle\Repository\GroupsRepository")
 */
class Groups
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
     * @var integer $userId
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var \DateTime $createdat
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime $updatedat
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=false)
     */
    private $updatedat;

    /**
     * @var Community
     *
     * @ORM\ManyToOne(targetEntity="Community")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     * })
     */
    private $community;
    /**
     * @ORM\ManyToMany(targetEntity="Campsite\AdminBundle\Entity\FosUser", mappedBy="groups")
     * @ORM\JoinTable(name="users_groups")
     */
    private $users;


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
     * Set userId
     *
     * @param integer $userId
     * @return Events
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
	
    /**
     * Set city
     *
     * @param string $city
     * @return Groups
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Groups
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Groups
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     * @return Groups
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
     * @return Groups
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
     * Set community
     *
     * @param Campsite\AdminBundle\Entity\Community $community
     * @return Groups
     */
    public function setCommunity(\Campsite\AdminBundle\Entity\Community $community = null)
    {
        $this->community = $community;
    
        return $this;
    }

    /**
     * Get community
     *
     * @return Campsite\AdminBundle\Entity\Community 
     */
    public function getCommunity()
    {
        return $this->community;
    }
}