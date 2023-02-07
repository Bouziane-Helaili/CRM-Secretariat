<?php

namespace App\Entity;

use App\Repository\CategoryFileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryFileRepository::class)]
class CategoryFile
{
const COMPAGNY = "Entreprise";
const EMPLOYE = "Employé";
const STAGIAIRE = "Stagiaire";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(['Employé', 'Stagiaire', 'Entreprise'])]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'categoryFile', targetEntity: CompagnyFile::class)]
    private Collection $compagnyFiles;

    #[ORM\OneToMany(mappedBy: 'categoryFile', targetEntity: UserFile::class)]
    private Collection $userFiles;

    public function __construct()
    {
        $this->compagnyFiles = new ArrayCollection();
        $this->userFiles = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, CompagnyFile>
     */
    public function getCompagnyFiles(): Collection
    {
        return $this->compagnyFiles;
    }

    public function addCompagnyFile(CompagnyFile $compagnyFile): self
    {
        if (!$this->compagnyFiles->contains($compagnyFile)) {
            $this->compagnyFiles->add($compagnyFile);
            $compagnyFile->setCategoryFile($this);
        }

        return $this;
    }

    public function removeCompagnyFile(CompagnyFile $compagnyFile): self
    {
        if ($this->compagnyFiles->removeElement($compagnyFile)) {
            // set the owning side to null (unless already changed)
            if ($compagnyFile->getCategoryFile() === $this) {
                $compagnyFile->setCategoryFile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserFile>
     */
    public function getUserFiles(): Collection
    {
        return $this->userFiles;
    }

    public function addUserFile(UserFile $userFile): self
    {
        if (!$this->userFiles->contains($userFile)) {
            $this->userFiles->add($userFile);
            $userFile->setCategoryFile($this);
        }

        return $this;
    }

    public function removeUserFile(UserFile $userFile): self
    {
        if ($this->userFiles->removeElement($userFile)) {
            // set the owning side to null (unless already changed)
            if ($userFile->getCategoryFile() === $this) {
                $userFile->setCategoryFile(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
