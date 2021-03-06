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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Address", inversedBy="contacts")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Phone", mappedBy="contact")
     */
    private $phones;
    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Email", mappedBy="contact")
     */
    private $emails;


    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

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



    public function addPhone(Address $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }
    /**
     * Remove phones
     *
     * @param Phone $phones
     */
    public function removePhone(Address $phone)
    {
        $this->phones->removeElement($phone);
    }
    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add emails
     *
     * @param email $email
     * @return Contact
     * @internal param email $emails
     */
    public function addEmail(\MainBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }
    /**
     * Remove email
     *
     * @param \MainBundle\Entity\Email $email
     */
    public function removeEmail(\MainBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }
    /**
     * Get email
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set address
     *
     * @param \MainBundle\Entity\Address $address
     * @return Contact
     */
    public function setAddress(\MainBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \MainBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
