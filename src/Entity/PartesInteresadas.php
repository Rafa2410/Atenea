<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartesInteresadasRepository")
 */
class PartesInteresadas
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
     * @ORM\OneToMany(targetEntity="App\Entity\Expectativa", mappedBy="ParteInteresada")
     */
    private $expectativas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoPartesInteresadas", inversedBy="partesInteresadas")
     */
    private $TipoParteInteresada;

    public function __construct()
    {
        $this->expectativas = new ArrayCollection();
    }

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

    /**
     * @return Collection|Expectativa[]
     */
    public function getExpectativas(): Collection
    {
        return $this->expectativas;
    }

    public function addExpectativa(Expectativa $expectativa): self
    {
        if (!$this->expectativas->contains($expectativa)) {
            $this->expectativas[] = $expectativa;
            $expectativa->setParteInteresada($this);
        }

        return $this;
    }

    public function removeExpectativa(Expectativa $expectativa): self
    {
        if ($this->expectativas->contains($expectativa)) {
            $this->expectativas->removeElement($expectativa);
            // set the owning side to null (unless already changed)
            if ($expectativa->getParteInteresada() === $this) {
                $expectativa->setParteInteresada(null);
            }
        }

        return $this;
    }

    public function getTipoParteInteresada(): ?TipoPartesInteresadas
    {
        return $this->TipoParteInteresada;
    }

    public function setTipoParteInteresada(?TipoPartesInteresadas $TipoParteInteresada): self
    {
        $this->TipoParteInteresada = $TipoParteInteresada;

        return $this;
    }
}
