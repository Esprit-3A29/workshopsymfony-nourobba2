<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Cascade;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $ref;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\Column(type: 'float')]
    private $moyenne;

    #[ORM\ManyToOne(targetEntity: Classroom::class, inversedBy: 'students')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private  ?classroom $classroom = null;

    public function getRef(): ?int
    {
        return $this->ref;
    }
    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
