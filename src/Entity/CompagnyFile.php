<?php

namespace App\Entity;

use App\Repository\CompagnyFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagnyFileRepository::class)]
class CompagnyFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'compagnyFiles')]
    private ?Compagny $compagny = null;

    #[ORM\ManyToOne(inversedBy: 'compagnyFiles')]
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

    public function getCompagny(): ?Compagny
    {
        return $this->compagny;
    }

    public function setCompagny(?Compagny $compagny): self
    {
        $this->compagny = $compagny;

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
