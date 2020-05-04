<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuestionRepository")
 */
class Cuestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $interno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubtipoCuestion", inversedBy="cuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subtipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Aspecto", mappedBy="cuestiones")
     */
    private $aspectos;

    public function __construct()
    {
        $this->aspectos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterno(): ?bool
    {
        return $this->interno;
    }

    public function setInterno(bool $interno): self
    {
        $this->interno = $interno;

        return $this;
    }

    public function getSubtipo(): ?SubtipoCuestion
    {
        return $this->subtipo;
    }

    public function setSubtipo(?SubtipoCuestion $subtipo): self
    {
        $this->subtipo = $subtipo;

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

    /**
     * @return Collection|Aspecto[]
     */
    public function getAspectos(): Collection
    {
        return $this->aspectos;
    }

    public function addAspecto(Aspecto $aspecto): self
    {
        if (!$this->aspectos->contains($aspecto)) {
            $this->aspectos[] = $aspecto;
            $aspecto->addAspectoCuestion($this);
        }

        return $this;
    }

    public function removeAspecto(Aspecto $aspecto): self
    {
        if ($this->aspectos->contains($aspecto)) {
            $this->aspectos->removeElement($aspecto);
            $aspecto->removeAspectoCuestion($this);
        }

        return $this;
    }
}
