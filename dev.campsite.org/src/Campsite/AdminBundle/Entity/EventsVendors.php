<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\EventsVendors
 *
 * @ORM\Table(name="events_vendors")
 * @ORM\Entity
 */
class EventsVendors
{


    /**
     * @var boolean $type
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @var Events
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @var Vendors
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Vendors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     * })
     */
    private $vendor;



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
     * Set type
     *
     * @param boolean $type
     * @return EventsVendors
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set event
     *
     * @param Campsite\AdminBundle\Entity\Events $event
     * @return EventsVendors
     */
    public function setEvent(\Campsite\AdminBundle\Entity\Events $event)
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

    /**
     * Set vendor
     *
     * @param Campsite\AdminBundle\Entity\Vendors $vendor
     * @return EventsVendors
     */
    public function setVendor(\Campsite\AdminBundle\Entity\Vendors $vendor)
    {
        $this->vendor = $vendor;
    
        return $this;
    }

    /**
     * Get vendor
     *
     * @return Campsite\AdminBundle\Entity\Vendors 
     */
    public function getVendor()
    {
        return $this->vendor;
    }
}