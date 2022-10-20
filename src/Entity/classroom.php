<?php

namespace App\Entity;

use App\Repository\classroomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: classroomRepository::class)]
class classroom
{
    #[ORM\Id]
   // #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getid(): ?string
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
        public function getNbrStudent(): ?int
        {
            return $this->nbrStudent;
        }
    
        public function setNbrStudent(int $nbrStudent): self
        {
            $this->nbrStudent = $nbrStudent;
    
            return $this;
    
        }
    }

