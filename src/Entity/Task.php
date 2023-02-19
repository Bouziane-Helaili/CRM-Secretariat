<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use App\Trait\HasIdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
   
use HasIdTrait;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $madeBy = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $user = null;

    public function getMadeBy(): ?string
    {
        return $this->madeBy;
    }

    public function setMadeBy(?string $madeBy): self
    {
        $this->madeBy = $madeBy;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
