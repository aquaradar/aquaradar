<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity
 */
class Notification {

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
     * @Assert\NotBlank(
     *  message = "O endereço não pode ser em branco"
     * )
     * @Assert\Length(max=255)
     *
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
     * @Assert\NotBlank(
     *     message = "Escolha uma localização válida."
     * )
     * 
     * @ORM\Column(name="longitude", type="decimal", precision=11, scale=8, nullable=false)
     */
    private $longitude;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=false, options={"comment"="0 - vazamento 1 - falta agua"})
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", nullable=false, options={ "comment"="0 - pendente 1 - resolvido 2 - fechado"})
     */
    private $status = 0;

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

    function getUpdated(): ?\DateTime {
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

    function getType() {
        return $this->type;
    }

    function getStatus() {
        return $this->status;
    }

    function getFosUserId() {
        return $this->fosUserId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setInserted(\DateTime $insert) {
        $this->inserted = $insert;
    }

    function setUpdated(\DateTime $update) {
        $this->updated = $update;
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

    function setType($type) {
        $this->type = $type;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setFosUserId($fosUserId) {
        $this->fosUserId = $fosUserId;
    }

}
