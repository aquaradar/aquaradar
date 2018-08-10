<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maintenance
 *
 * @ORM\Table(name="maintenance")
 * @ORM\Entity
 */
class Maintenance {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inserted", type="datetime", nullable=false)
     */
    private $inserted;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=10, scale=8, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=11, scale=8, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=false)
     */
    private $info;

    /**
     * @var int
     *
     * @ORM\Column(name="fos_user_id", type="integer", nullable=false)
     */
    private $fosUserId;

    function getId() {
        return $this->id;
    }

    function getInserted(): \DateTime {
        return $this->inserted;
    }

    function getUpdated(): \DateTime {
        return $this->updated;
    }

    function getAddress() {
        return $this->address;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getInfo() {
        return $this->info;
    }

    function getFosUserId() {
        return $this->fosUserId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setInserted(\DateTime $inserted) {
        $this->inserted = $inserted;
    }

    function setUpdated(\DateTime $updated) {
        $this->updated = $updated;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function setInfo($info) {
        $this->info = $info;
    }

    function setFosUserId($fosUserId) {
        $this->fosUserId = $fosUserId;
    }

}
