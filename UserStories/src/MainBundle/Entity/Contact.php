<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Address", mappedBy="contact")
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
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
     * Add addresses
     *
     * @param Address $address
     * @return Contact
     * @internal param Address $addresses
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }
    /**
     * Remove addresses
     *
     * @param Address $addresses
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }
    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
