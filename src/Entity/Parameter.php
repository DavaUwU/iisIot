<?php

namespace App\Entity;

use App\Repository\ParameterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParameterRepository::class)]
class Parameter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $value = null;

    #[ORM\Column(nullable: true)]
    private ?float $minValue = null;

    #[ORM\Column(nullable: true)]
    private ?float $FmaxValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getMinValue(): ?float
    {
        return $this->minValue;
    }

    public function setMinValue(?float $minValue): static
    {
        $this->minValue = $minValue;

        return $this;
    }

    public function getFmaxValue(): ?float
    {
        return $this->FmaxValue;
    }

    public function setFmaxValue(?float $FmaxValue): static
    {
        $this->FmaxValue = $FmaxValue;

        return $this;
    }
}
