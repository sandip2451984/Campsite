<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\Group
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="Campsite\AdminBundle\Repository\GroupsRepository")
 */
class Group
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
     * @var integer $communityId
     *
     * @ORM\Column(name="community_id", type="integer", nullable=false)
     */
    private $communityId;

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
     * @ORM\ManyToMany(targetEntity="Campsite\AdminBundle\Entity\FosUser", mappedBy="group")
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
     * Set communityId
     *
     * @param integer $communityId
     * @return Groups
     */
    public function setCommunityId($communityId)
    {
        $this->communityId = $communityId;
    
        return $this;
    }

    /**
     * Get communityId
     *
     * @return integer 
     */
    public function getCommunityId()
    {
        return $this->communityId;
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add users
     *
     * @param Campsite\AdminBundle\Entity\FosUser $users
     * @return Group
     */
    public function addUser(\Campsite\AdminBundle\Entity\FosUser $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param Campsite\AdminBundle\Entity\FosUser $users
     */
    public function removeUser(\Campsite\AdminBundle\Entity\FosUser $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}