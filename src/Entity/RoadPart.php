<?php

namespace App\Entity;

use App\Repository\RoadPartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadPartRepository::class)
 */
class RoadPart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Road::class, inversedBy="roadParts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $road;

    /**
     * @ORM\Column(type="integer")
     */
    private $start;

    /**
     * @ORM\Column(type="integer")
     */
    private $finish;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="roadParts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=Contract::class, mappedBy="RoadPart")
     */
    private $contracts;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoad(): ?Road
    {
        return $this->road;
    }

    public function setRoad(?Road $road): self
    {
        $this->road = $road;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?int
    {
        return $this->finish;
    }

    public function setFinish(int $finish): self
    {
        $this->finish = $finish;

        return $this;
    }

    public function getOwner(): ?Organization
    {
        return $this->owner;
    }

    public function setOwner(?Organization $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
            $contract->addRoadPart($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            $contract->removeRoadPart($this);
        }

        return $this;
    }
}
