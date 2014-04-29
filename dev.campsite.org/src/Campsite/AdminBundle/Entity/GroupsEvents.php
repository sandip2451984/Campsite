<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\GroupsEvents
 *
 * @ORM\Table(name="groups_events")
 * @ORM\Entity
 */
class GroupsEvents
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
     * @var Groups
     *
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

    /**
     * @var Events
     *
     * @ORM\ManyToOne(targetEntity="Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;



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
     * @param Campsite\AdminBundle\Entity\Groups $group
     * @return GroupsEvents
     */
    public function setGroup(\Campsite\AdminBundle\Entity\Groups $group = null)
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
     * Set event
     *
     * @param Campsite\AdminBundle\Entity\Events $event
     * @return GroupsEvents
     */
    public function setEvent(\Campsite\AdminBundle\Entity\Events $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return Campsite\AdminBundle\Entity\Events 
     */
    public function getEvent()
    {
        return $this->event;
    }
}