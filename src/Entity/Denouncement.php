<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Denouncement
 *
 * @ORM\Table(name="denouncement")
 * @ORM\Entity
 */
class Denouncement {

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
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message = "Choose a valid location."
     * )
     *
     * @ORM\Column(name="latitude", type="string", nullable=false)
     */
    private $latitude;

    /**
     * @var string
     * 
     * @ORM\Column(name="longitude", type="string", nullable=false)
     */
    private $longitude;

    /**
     * @var string
     * @Assert\NotBlank()
     * 
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="fos_user_id", type="integer", nullable=false)
     */
    private $fosUserId;
    
    public function getId() {
        return $this->id;
    }

    public function getInserted(): \DateTime {
        return $this->inserted;
    }

    public function getUpdated(): \DateTime {
        return $this->updated;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getFosUserId() {
        return $this->fosUserId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setInserted(\DateTime $inserted) {
        $this->inserted = $inserted;
    }

    public function setUpdated(\DateTime $updated) {
        $this->updated = $updated;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setFosUserId($fosUserId) {
        $this->fosUserId = $fosUserId;
    }

}
