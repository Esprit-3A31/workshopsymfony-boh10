<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
   // #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $nce = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getnce(): ?string
    {
        return $this->nce;
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
