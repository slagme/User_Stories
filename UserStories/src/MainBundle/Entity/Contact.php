<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener;

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
        $this->addresses = new ArrayCollection();
        $this->phones=new ArrayCollection();
        $this->emails=new ArrayCollection();
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
     * Add addresses
     *
     * @param phone $phone
     * @return Contact
     * @internal param Phone $phones
     */
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
    public function addEmail(Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }
    /**
     * Remove emails
     *
     * @param Email $emails
     */
    public function removeEmail(Email $email)
    {
        $this->emails->removeElement($email);
    }
    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
