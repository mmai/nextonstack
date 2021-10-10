<?php

namespace App\Entity;

use App\Repository\StackItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StackItemRepository::class)
 */
class StackItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Work::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $work;

    /**
     * @ORM\ManyToOne(targetEntity=Stack::class, inversedBy="stackItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stack;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="item")
     */
    private $votes;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWork(): ?Work
    {
        return $this->work;
    }

    public function setWork(?Work $work): self
    {
        $this->work = $work;

        return $this;
    }

    public function getStack(): ?Stack
    {
        return $this->stack;
    }

    public function setStack(?Stack $stack): self
    {
        $this->stack = $stack;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setItem($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getItem() === $this) {
                $vote->setItem(null);
            }
        }

        return $this;
    }
}
