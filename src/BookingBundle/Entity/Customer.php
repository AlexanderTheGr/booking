<?php

namespace BookingBundle\Entity;

/**
 * Customer
 */
class Customer {
    public function getField($field) {
        return $this->$field;
    }

    public function setField($field, $val) {
        $this->$field = $val;
        return $val;
    }
    /**
     * @var integer
     */
    private $reference;

    /**
     * @var integer
     */
    private $group;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $afm;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $city;

    /**
     * @var integer
     */
    private $zip;

    /**
     * @var string
     */
    private $phone01;

    /**
     * @var string
     */
    private $phone02;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $webpage;

    /**
     * @var integer
     */
    private $payment;

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
     * Set reference
     *
     * @param integer $reference
     *
     * @return Customer
     */
    public function setReference($reference) {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer
     */
    public function getReference() {
        return $this->reference;
    }

    /**
     * Set group
     *
     * @param integer $group
     *
     * @return Customer
     */
    public function setGroup($group) {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return integer
     */
    public function getGroup() {
        return $this->group;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Customer
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Customer
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Customer
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set afm
     *
     * @param string $afm
     *
     * @return Customer
     */
    public function setAfm($afm) {
        $this->afm = $afm;

        return $this;
    }

    /**
     * Get afm
     *
     * @return string
     */
    public function getAfm() {
        return $this->afm;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Customer
     */
    public function setDistrict($district) {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict() {
        return $this->district;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return Customer
     */
    public function setZip($zip) {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Set phone01
     *
     * @param string $phone01
     *
     * @return Customer
     */
    public function setPhone01($phone01) {
        $this->phone01 = $phone01;

        return $this;
    }

    /**
     * Get phone01
     *
     * @return string
     */
    public function getPhone01() {
        return $this->phone01;
    }

    /**
     * Set phone02
     *
     * @param string $phone02
     *
     * @return Customer
     */
    public function setPhone02($phone02) {
        $this->phone02 = $phone02;

        return $this;
    }

    /**
     * Get phone02
     *
     * @return string
     */
    public function getPhone02() {
        return $this->phone02;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Customer
     */
    public function setFax($fax) {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * Set webpage
     *
     * @param string $webpage
     *
     * @return Customer
     */
    public function setWebpage($webpage) {
        $this->webpage = $webpage;

        return $this;
    }

    /**
     * Get webpage
     *
     * @return string
     */
    public function getWebpage() {
        return $this->webpage;
    }

    /**
     * Set payment
     *
     * @param integer $payment
     *
     * @return Customer
     */
    public function setPayment($payment) {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return integer
     */
    public function getPayment() {
        return $this->payment;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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

}
