<?php

namespace App\Entity;

use App\Repository\RolesHabilitationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesHabilitationsRepository::class)]
class RolesHabilitations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Roles::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Roles $role = null;

    #[ORM\ManyToOne(targetEntity: Habilitations::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habilitations $habilitation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?Roles
{
    return $this->role;
}

public function setRole(?Roles $role): static
{
    $this->role = $role;
    return $this;
}

public function getHabilitation(): ?Habilitations
{
    return $this->habilitation;
}

public function setHabilitation(?Habilitations $habilitation): static
{
    $this->habilitation = $habilitation;
    return $this;
}

}
