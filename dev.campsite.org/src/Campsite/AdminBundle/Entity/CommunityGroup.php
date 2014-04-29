<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\CommunityGroup
 *
 * @ORM\Table(name="community_group")
 * @ORM\Entity
 */
class CommunityGroup
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
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set group
     *
     * @param Campsite\AdminBundle\Entity\Group $group
     * @return CommunityGroup
     */
    public function setGroup(\Campsite\AdminBundle\Entity\Group $group = null)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return Campsite\AdminBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set community
     *
     * @param Campsite\AdminBundle\Entity\Community $community
     * @return CommunityGroup
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