<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use App\Trait\HasIdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints\Unique;
// use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
// #[UniqueEntity(message: "{{ value }} existe déjà")]
class Status
{
    
use HasIdTrait;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setStatus($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getStatus() === $this) {
                $user->setStatus(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
