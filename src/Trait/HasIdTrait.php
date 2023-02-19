<?php

namespace App\Trait;

use Doctrine\ORM\Mapping as ORM;

trait HasIdTrait{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[ORM\Column(length: 255)]
    // #[Assert\Regex(
    //     pattern: '/\d/',
    //     match: false,
    //     message: 'Votre nom ne peut pas contenir un chiffre',
    // )]
    private ?string $name = null;

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

}