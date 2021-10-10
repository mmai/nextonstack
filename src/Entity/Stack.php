<?php

namespace App\Entity;

use App\Repository\StackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StackRepository::class)
 */
class Stack
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
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="stacks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=StackItem::class, mappedBy="stack", orphanRemoval=true)
     */
    private $stackItems;

    public function __construct()
    {
        $this->stackItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|StackItem[]
     */
    public function getStackItems(): Collection
    {
        return $this->stackItems;
    }

    public function addStackItem(StackItem $stackItem): self
    {
        if (!$this->stackItems->contains($stackItem)) {
            $this->stackItems[] = $stackItem;
            $stackItem->setStack($this);
        }

        return $this;
    }

    public function removeStackItem(StackItem $stackItem): self
    {
        if ($this->stackItems->removeElement($stackItem)) {
            // set the owning side to null (unless already changed)
            if ($stackItem->getStack() === $this) {
                $stackItem->setStack(null);
            }
        }

        return $this;
    }
}
