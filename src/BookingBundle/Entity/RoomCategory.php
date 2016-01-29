<?php

namespace BookingBundle\Entity;

use AppBundle\Entity\Entity;
/**
 * RoomCategory
 */
class RoomCategory extends Entity  {


    private $repository = 'BookingBundle:RoomCategory';
    private $types = array();
    private $repositories = array();

    public function __construct() {
        //$this->repositories['RoomCategory'] = 'BookingBundle:RoomCategory';
        //$this->types['RoomCategory'] = 'object';
        //$this->RoomCategory = new \BookingBundle\Entity\RoomCategory;
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
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
        //return;
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
     * Set description
     *
     * @param string $description
     *
     * @return RoomCategory
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
     * @return RoomCategory
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
     * @return RoomCategory
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return RoomCategory
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
     * @return RoomCategory
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
     * Set actioneer
     *
     * @param \AppBundle\Entity\User $actioneer
     *
     * @return RoomCategory
     */
    public function setActioneer(\AppBundle\Entity\User $actioneer = null) {
        $this->actioneer = $actioneer;

        return $this;
    }

    /**
     * Get actioneer
     *
     * @return \AppBundle\Entity\User
     */
    public function getActioneer() {
        return $this->actioneer;
    }

    /**
     * @var string
     */
    private $title;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RoomCategory
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rooms;



    /**
     * Add room
     *
     * @param \BookingBundle\Entity\Room $room
     *
     * @return RoomCategory
     */
    public function addRoom(\BookingBundle\Entity\Room $room) {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \BookingBundle\Entity\Room $room
     */
    public function removeRoom(\BookingBundle\Entity\Room $room) {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms() {
        return $this->rooms;
    }
    public function getRoomIds() {
        $ids = array();
        foreach ($this->rooms as $room) {
            $ids[] = $room->getId();
        }
        return $ids;
    }    

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $seasons;


    /**
     * Add season
     *
     * @param \BookingBundle\Entity\RoomCategorySeason $season
     *
     * @return RoomCategory
     */
    public function addSeason(\BookingBundle\Entity\RoomCategorySeason $season)
    {
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \BookingBundle\Entity\RoomCategorySeason $season
     */
    public function removeSeason(\BookingBundle\Entity\RoomCategorySeason $season)
    {
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
}
