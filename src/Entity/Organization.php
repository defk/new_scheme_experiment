<?php

namespace App\Entity;

use App\Repository\OrganizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 */
class Organization
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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="organization")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=RoadPart::class, mappedBy="owner")
     */
    private $roadParts;

    /**
     * @ORM\OneToMany(targetEntity=Contract::class, mappedBy="customer")
     */
    private $contracts;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->roadParts = new ArrayCollection();
        $this->contracts = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setOrganization($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getOrganization() === $this) {
                $user->setOrganization(null);
            }
        }

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
            $roadPart->setOwner($this);
        }

        return $this;
    }

    public function removeRoadPart(RoadPart $roadPart): self
    {
        if ($this->roadParts->removeElement($roadPart)) {
            // set the owning side to null (unless already changed)
            if ($roadPart->getOwner() === $this) {
                $roadPart->setOwner(null);
            }
        }

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
            $contract->setCustomer($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getCustomer() === $this) {
                $contract->setCustomer(null);
            }
        }

        return $this;
    }
}
