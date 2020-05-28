<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuestionUnidadRepository")
 */
class CuestionUnidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cuestion", inversedBy="cuestionUnidads")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $cuestion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadDeGestion", inversedBy="cuestionUnidads")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $unidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuestion(): ?Cuestion
    {
        return $this->cuestion;
    }

    public function setCuestion(?Cuestion $cuestion): self
    {
        $this->cuestion = $cuestion;

        return $this;
    }

    public function getUnidad(): ?UnidadDeGestion
    {
        return $this->unidad;
    }

    public function setUnidad(?UnidadDeGestion $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }
}
