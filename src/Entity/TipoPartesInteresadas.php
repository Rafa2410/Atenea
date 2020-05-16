<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoPartesInteresadasRepository")
 */
class TipoPartesInteresadas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartesInteresadas", inversedBy="tipoPartesInteresadas")
     */
    private $parte_interesada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getParteInteresada(): ?PartesInteresadas
    {
        return $this->parte_interesada;
    }

    public function setParteInteresada(?PartesInteresadas $parte_interesada): self
    {
        $this->parte_interesada = $parte_interesada;

        return $this;
    }
}
