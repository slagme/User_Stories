<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\EmailRepository")
 */
class Email
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
     * @ORM\Column(name="EmailAddress", type="string", length=100, unique=true)
     */
    private $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="EmailType", type="string", length=100)
     */
    private $emailType;


    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Contact", inversedBy="phones")
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
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return Email
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set emailType
     *
     * @param string $emailType
     * @return Email
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;

        return $this;
    }

    /**
     * Get emailType
     *
     * @return string 
     */
    public function getEmailType()
    {
        return $this->emailType;
    }

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
