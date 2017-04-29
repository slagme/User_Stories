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
     * @ORM\Column(name="houseNumber", type="string", length=10)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="houseUnitNumber", type="string", length=10, nullable=true)
     */
    private $houseUnitNumber;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Contact", inversedBy="addresses")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
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
     * @param \MainBundle\Entity\Contact $contact
     * @return Address
     */
    public function setContact(\MainBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }
    /**
     * Get contact
     *
     * @return \MainBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

}
