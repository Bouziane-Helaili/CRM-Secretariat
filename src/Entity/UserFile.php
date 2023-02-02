<?php

namespace App\Entity;

use App\Repository\UserFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserFileRepository::class)]
class UserFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'userFiles')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userFiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryFile $categoryFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getCategoryFile(): ?CategoryFile
    {
        return $this->categoryFile;
    }

    public function setCategoryFile(?CategoryFile $categoryFile): self
    {
        $this->categoryFile = $categoryFile;

        return $this;
    }
}
