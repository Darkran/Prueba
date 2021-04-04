<?php

namespace App\Entity;

use App\Repository\ConversionesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ConversionesRepository::class)
 */
class Conversiones {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $origen;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     */
    private $cantidad;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $destino;

    /**
     * @ORM\Column(type="float")
     */
    private $resultado;

    /**
     * @ORM\Column(type="float")
     */
    private $ratio;

    public function getId(): ?int {
        return $this->id;
    }

    public function getOrigen(): ?string {
        return $this->origen;
    }

    public function setOrigen(string $origen): self {
        $this->origen = $origen;

        return $this;
    }

    public function getDestino(): ?string {
        return $this->destino;
    }

    public function setDestino(string $destino): self {
        $this->destino = $destino;

        return $this;
    }

    public function getCantidad(): ?float {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): self {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self {
        $this->fecha = $fecha;

        return $this;
    }

    public function getResultado(): ?float
    {
        return $this->resultado;
    }

    public function setResultado(float $resultado): self
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getRatio(): ?float
    {
        return $this->ratio;
    }

    public function setRatio(float $ratio): self
    {
        $this->ratio = $ratio;

        return $this;
    }

}
