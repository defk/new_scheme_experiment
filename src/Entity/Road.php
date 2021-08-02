<?php

namespace App\Entity;

use App\Repository\RoadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadRepository::class)
 */
class Road
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderRank;

    /**
     * @ORM\OneToMany(targetEntity=RoadPart::class, mappedBy="road")
     */
    private $roadParts;

    public function __construct()
    {
        $this->roadParts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getOrderRank(): ?int
    {
        return $this->orderRank;
    }

    public function setOrderRank(int $orderRank): self
    {
        $this->orderRank = $orderRank;

        return $this;
    }

    /**
     * @return Collection|RoadPart[]
     */
    public function getRoadParts(): Collection
    {
        return $this->roadParts;
    }

    public function addRoadPart(RoadPart $roadPart): self
    {
        if (!$this->roadParts->contains($roadPart)) {
            $this->roadParts[] = $roadPart;
            $roadPart->setRoad($this);
        }

        return $this;
    }

    public function removeRoadPart(RoadPart $roadPart): self
    {
        if ($this->roadParts->removeElement($roadPart)) {
            // set the owning side to null (unless already changed)
            if ($roadPart->getRoad() === $this) {
                $roadPart->setRoad(null);
            }
        }

        return $this;
    }
}
