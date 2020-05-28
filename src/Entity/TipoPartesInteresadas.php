<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadDeGestion", inversedBy="tipoPartesInteresadas", cascade={"persist", "remove"})
     */
    private $UnidadDeGestion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PartesInteresadas", mappedBy="TipoParteInteresada", cascade={"persist", "remove"})
     */
    private $partesInteresadas;

    public function __construct()
    {
        $this->partesInteresadas = new ArrayCollection();
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
        return $this->UnidadDeGestion;
    }

    public function setUnidadDeGestion(?UnidadDeGestion $UnidadDeGestion): self
    {
        $this->UnidadDeGestion = $UnidadDeGestion;

        return $this;
    }

    /**
     * @return Collection|PartesInteresadas[]
     */
    public function getPartesInteresadas(): Collection
    {
        return $this->partesInteresadas;
    }

    public function addPartesInteresada(PartesInteresadas $partesInteresada): self
    {
        if ( ! $this->partesInteresadas->contains($partesInteresada)) {
            $this->partesInteresadas[] = $partesInteresada;
            $partesInteresada->setTipoParteInteresada($this);
        }

        return $this;
    }

    public function removePartesInteresada(PartesInteresadas $partesInteresada): self
    {
        if ($this->partesInteresadas->contains($partesInteresada)) {
            $this->partesInteresadas->removeElement($partesInteresada);
            // set the owning side to null (unless already changed)
            if ($partesInteresada->getTipoParteInteresada() === $this) {
                $partesInteresada->setTipoParteInteresada(null);
            }
        }

        return $this;
    }
}
