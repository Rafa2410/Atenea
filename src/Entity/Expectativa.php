<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpectativaRepository")
 */
class Expectativa
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
     * @ORM\ManyToOne(targetEntity="App\Entity\PartesInteresadas", inversedBy="expectativas")
     */
    private $ParteInteresada;

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
        return $this->ParteInteresada;
    }

    public function setParteInteresada(?PartesInteresadas $ParteInteresada): self
    {
        $this->ParteInteresada = $ParteInteresada;

        return $this;
    }
}
