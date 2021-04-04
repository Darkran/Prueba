<?php

namespace App\Entity;

use App\Repository\EmpresasRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmpresasRepository::class)
 */
class Empresas {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Email(
     *      message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Sectores::class)
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank
     */
    private $sector;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTelefono(): ?int {
        return $this->telefono;
    }

    public function setTelefono(?int $telefono): self {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getSector(): ?Sectores {
        return $this->sector;
    }

    public function setSector(?Sectores $sector): self {
        $this->sector = $sector;

        return $this;
    }

}
