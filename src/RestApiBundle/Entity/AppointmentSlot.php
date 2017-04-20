<?php

namespace RestApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppointmentSlot
 *
 * @ORM\Table(name="appointment_slot", indexes={@ORM\Index(name="IDX_BFCDE8A64066877A", columns={"stylist_id"}), @ORM\Index(name="start_idx", columns={"start"})})
 * @ORM\Entity
 */
class AppointmentSlot
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
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime", nullable=false)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=false)
     */
    private $end;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = '1';

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
     * Set id
     *
     * @param int $id
     *
     * @return AppointmentSlot
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return AppointmentSlot
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return AppointmentSlot
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return AppointmentSlot
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return AppointmentSlot
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
}

