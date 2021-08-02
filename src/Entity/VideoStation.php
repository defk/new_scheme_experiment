<?php

namespace App\Entity;

use App\Repository\VideoStationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoStationRepository::class)
 */
class VideoStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Road::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $road;

    /**
     * @ORM\Column(type="integer")
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoad(): ?Road
    {
        return $this->road;
    }

    public function setRoad(Road $road): self
    {
        $this->road = $road;

        return $this;
    }

    public function getAddress(): ?int
    {
        return $this->address;
    }

    public function setAddress(int $address): self
    {
        $this->address = $address;

        return $this;
    }
}
