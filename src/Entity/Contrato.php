<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratoRepository")
 */
class Contrato
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_baja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UnidadDeGestion")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $unidad_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {                
        return $this->fecha_alta;
    }

    public function setFechaAlta(\DateTimeInterface $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fecha_baja;
    }

    public function setFechaBaja(?\DateTimeInterface $fecha_baja): self
    {
        $this->fecha_baja = $fecha_baja;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUnidadId(): ?UnidadDeGestion
    {
        return $this->unidad_id;
    }

    public function setUnidadId(UnidadDeGestion $unidad_id): self
    {
        $this->unidad_id = $unidad_id;

        return $this;
    }
}
