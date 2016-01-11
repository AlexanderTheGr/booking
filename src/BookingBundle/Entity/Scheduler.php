<?php

namespace BookingBundle\Entity;

/**
 * Scheduler
 */
class Scheduler
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $ts = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\User
     */
    private $actioneer;

    /**
     * @var \BookingBundle\Entity\Room
     */
    private $category;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Scheduler
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
     * Set status
     *
     * @param integer $status
     *
     * @return Scheduler
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set ts
     *
     * @param \DateTime $ts
     *
     * @return Scheduler
     */
    public function setTs($ts)
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * Get ts
     *
     * @return \DateTime
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Scheduler
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Scheduler
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
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
     * Set actioneer
     *
     * @param \AppBundle\Entity\User $actioneer
     *
     * @return Scheduler
     */
    public function setActioneer(\AppBundle\Entity\User $actioneer = null)
    {
        $this->actioneer = $actioneer;

        return $this;
    }

    /**
     * Get actioneer
     *
     * @return \AppBundle\Entity\User
     */
    public function getActioneer()
    {
        return $this->actioneer;
    }

    /**
     * Set category
     *
     * @param \BookingBundle\Entity\Room $category
     *
     * @return Scheduler
     */
    public function setCategory(\BookingBundle\Entity\Room $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BookingBundle\Entity\Room
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \BookingBundle\Entity\Room
     */
    private $room;


    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Scheduler
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
     * @return Scheduler
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
     * Set room
     *
     * @param \BookingBundle\Entity\Room $room
     *
     * @return Scheduler
     */
    public function setRoom(\BookingBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \BookingBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }
    /**
     * @var \BookingBundle\Entity\Customer
     */
    private $customer;


    /**
     * Set customer
     *
     * @param \BookingBundle\Entity\Customer $customer
     *
     * @return Scheduler
     */
    public function setCustomer(\BookingBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \BookingBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
