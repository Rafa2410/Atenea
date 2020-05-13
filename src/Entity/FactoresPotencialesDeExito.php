<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactoresPotencialesDeExitoRepository")
 */
class FactoresPotencialesDeExito
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
    private $descripcion;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_baja;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Aspecto", inversedBy="factoresPotencialesDeExitos")
     */
    private $aspecto;

    private $aspectosFav;

    private $aspectosDes;

    public function __construct()
    {
        $this->aspecto = new ArrayCollection();
        $this->aspectosFav = new ArrayCollection();
        $this->aspectosDes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Aspecto[]
     */
    public function getAspecto(): Collection
    {
        return $this->aspecto;
    }

    public function addAspecto(Aspecto $aspecto): self
    {
        if (!$this->aspecto->contains($aspecto)) {
            $this->aspecto[] = $aspecto;
        }

        return $this;
    }

    public function removeAspecto(Aspecto $aspecto): self
    {
        if ($this->aspecto->contains($aspecto)) {
            $this->aspecto->removeElement($aspecto);
        }

        return $this;
    }

    /**
     * @return Collection|Aspecto[]
     */
    public function getAspectosFav()
    {
        return $this->aspectosFav;
    }

    public function addAspectosFav(Aspecto $aspectosFav): self
    {

        if (!$this->aspectosFav->contains($aspectosFav)) {
            $this->aspectosFav[] = $aspectosFav;
        }

        return $this;
    }

    public function removeAspectosFav(Aspecto $aspectosFav): self
    {
        if ($this->aspectosFav->contains($aspectosFav)) {
            $this->aspectosFav->removeElement($aspectosFav);
        }

        return $this;
    }

    /**
     * @return Collection|Aspecto[]
     */
    public function getAspectosDes()
    {
        return $this->aspectosDes;
    }

    public function addAspectosDes(Aspecto $aspectosDes): self
    {
        if (!$this->aspectosDes->contains($aspectosDes)) {
            $this->aspectosDes[] = $aspectosDes;
        }

        return $this;
    }

    public function removeAspectosDes(Aspecto $aspectosDes): self
    {
        if ($this->aspectosDes->contains($aspectosDes)) {
            $this->aspectosDes->removeElement($aspectosDes);
        }

        return $this;
    }

}
