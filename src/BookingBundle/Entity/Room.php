<?php

namespace BookingBundle\Entity;

/**
 * Room
 */
class Room {
    public function getField($field) {
        return $this->$field;
    }

    public function setField($field, $val) {
        $this->$field = $val;
        return $val;
    }
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
     * @var integer
     */
    private $actioneer;

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
     * Set description
     *
     * @param string $description
     *
     * @return Room
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Room
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set ts
     *
     * @param \DateTime $ts
     *
     * @return Room
     */
    public function setTs($ts) {
        $this->ts = $ts;

        return $this;
    }

    /**
     * Get ts
     *
     * @return \DateTime
     */
    public function getTs() {
        return $this->ts;
    }

    /**
     * Set actioneer
     *
     * @param integer $actioneer
     *
     * @return Room
     */
    public function setActioneer($actioneer) {
        $this->actioneer = $actioneer;

        return $this;
    }

    /**
     * Get actioneer
     *
     * @return integer
     */
    public function getActioneer() {
        return $this->actioneer;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Room
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Room
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified() {
        return $this->modified;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @var \BookingBundle\Entity\RoomCategory
     */
    private $category;

    /**
     * Set category
     *
     * @param \BookingBundle\Entity\RoomCategory $category
     *
     * @return Room
     */
    public function setCategory(\BookingBundle\Entity\RoomCategory $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BookingBundle\Entity\RoomCategory
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $schedulers;

    /**
     * Constructor
     */
    public function __construct() {
        $this->schedulers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add scheduler
     *
     * @param \BookingBundle\Entity\Scheduler $scheduler
     *
     * @return Room
     */
    public function addScheduler(\BookingBundle\Entity\Scheduler $scheduler) {
        $this->schedulers[] = $scheduler;

        return $this;
    }

    /**
     * Remove scheduler
     *
     * @param \BookingBundle\Entity\Scheduler $scheduler
     */
    public function removeScheduler(\BookingBundle\Entity\Scheduler $scheduler) {
        $this->schedulers->removeElement($scheduler);
    }

    /**
     * Get schedulers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedulers() {
        return $this->schedulers;
    }

    /**
     * @var integer
     */
    private $amount;


    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Room
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
