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
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadDeGestion", inversedBy="partesInteresadas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unidad_de_gestion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TipoPartesInteresadas", mappedBy="parte_interesada")
     */
    private $tipoPartesInteresadas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExpectativaPartesInteresadas", mappedBy="parte_interesada")
     */
    private $expectativaPartesInteresadas;

    public function __construct()
    {
        $this->tipoPartesInteresadas = new ArrayCollection();
        $this->expectativaPartesInteresadas = new ArrayCollection();
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

    public function getUnidadDeGestion(): ?UnidadDeGestion
    {
        return $this->unidad_de_gestion;
    }

    public function setUnidadDeGestion(?UnidadDeGestion $unidad_de_gestion): self
    {
        $this->unidad_de_gestion = $unidad_de_gestion;

        return $this;
    }

    /**
     * @return Collection|TipoPartesInteresadas[]
     */
    public function getTipoPartesInteresadas(): Collection
    {
        return $this->tipoPartesInteresadas;
    }

    public function addTipoPartesInteresada(TipoPartesInteresadas $tipoPartesInteresada): self
    {
        if (!$this->tipoPartesInteresadas->contains($tipoPartesInteresada)) {
            $this->tipoPartesInteresadas[] = $tipoPartesInteresada;
            $tipoPartesInteresada->setParteInteresada($this);
        }

        return $this;
    }

    public function removeTipoPartesInteresada(TipoPartesInteresadas $tipoPartesInteresada): self
    {
        if ($this->tipoPartesInteresadas->contains($tipoPartesInteresada)) {
            $this->tipoPartesInteresadas->removeElement($tipoPartesInteresada);
            // set the owning side to null (unless already changed)
            if ($tipoPartesInteresada->getParteInteresada() === $this) {
                $tipoPartesInteresada->setParteInteresada(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExpectativaPartesInteresadas[]
     */
    public function getExpectativaPartesInteresadas(): Collection
    {
        return $this->expectativaPartesInteresadas;
    }

    public function addExpectativaPartesInteresada(ExpectativaPartesInteresadas $expectativaPartesInteresada): self
    {
        if (!$this->expectativaPartesInteresadas->contains($expectativaPartesInteresada)) {
            $this->expectativaPartesInteresadas[] = $expectativaPartesInteresada;
            $expectativaPartesInteresada->setParteInteresada($this);
        }

        return $this;
    }

    public function removeExpectativaPartesInteresada(ExpectativaPartesInteresadas $expectativaPartesInteresada): self
    {
        if ($this->expectativaPartesInteresadas->contains($expectativaPartesInteresada)) {
            $this->expectativaPartesInteresadas->removeElement($expectativaPartesInteresada);
            // set the owning side to null (unless already changed)
            if ($expectativaPartesInteresada->getParteInteresada() === $this) {
                $expectativaPartesInteresada->setParteInteresada(null);
            }
        }

        return $this;
    }
}
