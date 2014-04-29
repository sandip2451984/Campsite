<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\UsersGroups
 *
 * @ORM\Table(name="users_groups")
 * @ORM\Entity
 */
class UsersGroups
{
 

    /**
     * @var Groups
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

    /**
     * @var FosUser
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Campsite\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fosuser_id", referencedColumnName="id")
     * })
     */
    private $fosuser;



  

    /**
     * Set group
     *
     * @param Campsite\AdminBundle\Entity\Groups $group
     * @return UsersGroups
     */
    public function setGroup(\Campsite\AdminBundle\Entity\Groups $group)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return Campsite\AdminBundle\Entity\Groups 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set fosuser
     *
     * @param Campsite\AdminBundle\Entity\FosUser $fosuser
     * @return UsersGroups
     */
    public function setFosuser(\Campsite\UserBundle\Entity\User $fosuser)
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
}