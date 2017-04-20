<?php

namespace RestApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment", indexes={@ORM\Index(name="IDX_FE38F8449395C3F3", columns={"customer_id"}), @ORM\Index(name="IDX_FE38F84459E5119C", columns={"slot_id"}), @ORM\Index(name="IDX_FE38F8444066877A", columns={"stylist_id"})})
 * @ORM\Entity
 */
class Appointment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime", nullable=false)
     */
    private $modifiedAt;

    /**
     * @var \RestApiBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stylist_id", referencedColumnName="id")
     * })
     */
    private $stylist;

    /**
     * @var \RestApiBundle\Entity\AppointmentSlot
     *
     * @ORM\ManyToOne(targetEntity="AppointmentSlot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="slot_id", referencedColumnName="id")
     * })
     */
    private $slot;

    /**
     * @var \RestApiBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Appointment
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Appointment
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
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return Appointment
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
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
     * Set stylist
     *
     * @param \RestApiBundle\Entity\Users $stylist
     *
     * @return Appointment
     */
    public function setStylist(\RestApiBundle\Entity\Users $stylist = null)
    {
        $this->stylist = $stylist;

        return $this;
    }

    /**
     * Get stylist
     *
     * @return \RestApiBundle\Entity\Users
     */
    public function getStylist()
    {
        return $this->stylist;
    }

    /**
     * Set slot
     *
     * @param \RestApiBundle\Entity\AppointmentSlot $slot
     *
     * @return Appointment
     */
    public function setSlot(\RestApiBundle\Entity\AppointmentSlot $slot = null)
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Get slot
     *
     * @return \RestApiBundle\Entity\AppointmentSlot
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set customer
     *
     * @param \RestApiBundle\Entity\Users $customer
     *
     * @return Appointment
     */
    public function setCustomer(\RestApiBundle\Entity\Users $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \RestApiBundle\Entity\Users
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}

