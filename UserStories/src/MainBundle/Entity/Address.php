<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=8)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="house_unit_number", type="string", length=8, nullable=true)
     */
    private $houseUnitNumber;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Contact", inversedBy="addresses")
     */

    private $contact;


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
     * Set city
     *
     * @param string $city
     * @return Address
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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     * @return Address
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string 
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set houseUnitNumber
     *
     * @param string $houseUnitNumber
     * @return Address
     */
    public function setHouseUnitNumber($houseUnitNumber)
    {
        $this->houseUnitNumber = $houseUnitNumber;

        return $this;
    }

    /**
     * Get houseUnitNumber
     *
     * @return string 
     */
    public function getHouseUnitNumber()
    {
        return $this->houseUnitNumber;
    }

    /**
     * Set contact
     *
     * @param \MainBundle\Entity\Address $contact
     * @return Address
     */
    public function setContact(\MainBundle\Entity\Address $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \MainBundle\Entity\Address 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
