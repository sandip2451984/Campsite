<?php

namespace Campsite\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campsite\AdminBundle\Entity\Vendors
 *
 * @ORM\Table(name="vendors")
 * @ORM\Entity(repositoryClass="Campsite\AdminBundle\Repository\VendorsRepository")
 */
class Vendors
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
     * @var string $companyName
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=false)
     */
    private $companyName;

    /**
     * @var string $companyLogo
     *
     * @ORM\Column(name="company_logo", type="string", length=255, nullable=false)
     */
    private $companyLogo;

    /**
     * @var string $companyUrl
     *
     * @ORM\Column(name="company_url", type="string", length=255, nullable=false)
     */
    private $companyUrl;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string $facebookUrl
     *
     * @ORM\Column(name="facebook_url", type="string", length=255, nullable=true)
     */
    private $facebookUrl;

    /**
     * @var string $twitterUrl
     *
     * @ORM\Column(name="twitter_url", type="string", length=255, nullable=true)
     */
    private $twitterUrl;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;



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
     * Set companyName
     *
     * @param string $companyName
     * @return Vendors
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    
        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyLogo
     *
     * @param string $companyLogo
     * @return Vendors
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;
    
        return $this;
    }

    /**
     * Get companyLogo
     *
     * @return string 
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * Set companyUrl
     *
     * @param string $companyUrl
     * @return Vendors
     */
    public function setCompanyUrl($companyUrl)
    {
        $this->companyUrl = $companyUrl;
    
        return $this;
    }

    /**
     * Get companyUrl
     *
     * @return string 
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Vendors
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set facebookUrl
     *
     * @param string $facebookUrl
     * @return Vendors
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    
        return $this;
    }

    /**
     * Get facebookUrl
     *
     * @return string 
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     * @return Vendors
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    
        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string 
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Vendors
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Vendors
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Vendors
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}