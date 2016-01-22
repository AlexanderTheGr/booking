<?php

namespace BookingBundle\Entity;

use AppBundle\Entity\Entity;
/**
 * Room
 */
class Room extends Entity {

    private $repository = 'BookingBundle:Room';
    private $types = array();
    private $repositories = array();

    public function __construct() {
        $this->repositories['RoomCategory'] = 'BookingBundle:RoomCategory';
        $this->types['RoomCategory'] = 'object';
        $this->RoomCategory = new \BookingBundle\Entity\RoomCategory;
        $this->schedulers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seasons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getField($field) {
        return $this->$field;
    }

    public function setField($field, $val) {
        $this->$field = $val;
        return $val;
    }

    public function getRepository() {
        return $this->repository;
    }

    public function gettype($field) {
        if (@$this->types[$field] != '') {
            return @$this->types[$field];
        }
        if (gettype($field) != NULL) {
            return gettype($this->$field);
        }
        return 'string';
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
    private $RoomCategory;

    /**
     * Set roomCategory
     *
     * @param \BookingBundle\Entity\RoomCategory $roomCategory
     *
     * @return Room
     */
    public function setRoomCategory(\BookingBundle\Entity\RoomCategory $roomCategory = null) {
        $this->RoomCategory = $roomCategory;
        return $this;
    }

    /**
     * Get category
     *
     * @return \BookingBundle\Entity\RoomCategory
     */
    public function getRoomCategory() {
        return $this->RoomCategory;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $schedulers;

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
    private $number;

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Room
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $seasons;

    /**
     * Add season
     *
     * @param \BookingBundle\Entity\RoomSeason $season
     *
     * @return Room
     */
    public function addSeason(\BookingBundle\Entity\RoomSeason $season) {
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \BookingBundle\Entity\RoomSeason $season
     */
    public function removeSeason(\BookingBundle\Entity\RoomSeason $season) {
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons() {
        return $this->seasons;
    }

}
