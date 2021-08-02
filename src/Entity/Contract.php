<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContractRepository::class)
 */
class Contract
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
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $executor;

    /**
     * @ORM\ManyToMany(targetEntity=RoadPart::class, inversedBy="contracts")
     */
    private $RoadPart;

    public function __construct()
    {
        $this->RoadPart = new ArrayCollection();
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

    public function getCustomer(): ?Organization
    {
        return $this->customer;
    }

    public function setCustomer(?Organization $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getExecutor(): ?Organization
    {
        return $this->executor;
    }

    public function setExecutor(?Organization $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    /**
     * @return Collection|RoadPart[]
     */
    public function getRoadPart(): Collection
    {
        return $this->RoadPart;
    }

    public function addRoadPart(RoadPart $roadPart): self
    {
        if (!$this->RoadPart->contains($roadPart)) {
            $this->RoadPart[] = $roadPart;
        }

        return $this;
    }

    public function removeRoadPart(RoadPart $roadPart): self
    {
        $this->RoadPart->removeElement($roadPart);

        return $this;
    }
}
