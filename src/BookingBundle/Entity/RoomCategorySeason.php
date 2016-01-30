<?php

namespace BookingBundle\Entity;

use AppBundle\Entity\Entity;

/**
 * RoomCategorySeason
 */
class RoomCategorySeason extends Entity {
    
    
    private $repository = 'BookingBundle:RoomCategorySeason';

    /**
     * @protected string
     */
    protected $description;

    /**
     * @protected integer
     */
    private $status;

    /**
     * @protected \DateTime
     */
    private $start;

    /**
     * @protected \DateTime
     */
    private $end;

    /**
     * @protected \DateTime
     */
    private $ts = 'CURRENT_TIMESTAMP';

    /**
     * @protected \DateTime
     */
    private $created;

    /**
     * @protected \DateTime
     */
    private $modified;

    /**
     * @protected integer
     */
    protected $id;

    /**
     * @protected \AppBundle\Entity\User
     */
    private $actioneer;

    /**
     * @protected \BookingBundle\Entity\RoomCategory
     */
    protected $RoomCategory;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return RoomCategorySeason
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
     * @return RoomCategorySeason
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return RoomCategorySeason
     */
    public function setStart($start) {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return RoomCategorySeason
     */
    public function setEnd($end) {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Set ts
     *
     * @param \DateTime $ts
     *
     * @return RoomCategorySeason
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
     * @return RoomCategorySeason
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
     * @return RoomCategorySeason
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
     * @return RoomCategorySeason
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
     * Set roomCategory
     *
     * @param \BookingBundle\Entity\RoomCategory $roomCategory
     *
     * @return RoomCategorySeason
     */
    public function setRoomCategory(\BookingBundle\Entity\RoomCategory $roomCategory = null) {
        $this->RoomCategory = $roomCategory;

        return $this;
    }

    /**
     * Get roomCategory
     *
     * @return \BookingBundle\Entity\RoomCategory
     */
    public function getRoomCategory() {
        return $this->RoomCategory;
    }

    /**
     * @protected string
     */
    protected $value;

    /**
     * Set value
     *
     * @param string $value
     *
     * @return RoomCategorySeason
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

}
