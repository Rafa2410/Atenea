<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AspectoRepository")
 */
class Aspecto
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
    private $favorable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $interno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cuestion", inversedBy="aspectos")
     */
    private $cuestiones;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FactoresPotencialesDeExito", mappedBy="aspecto")
     */
    private $factoresPotencialesDeExitos;

    private $aspectosFav;

    private $aspectosDes;

    public function __construct()
    {
        $this->cuestiones = new ArrayCollection();
        $this->factoresPotencialesDeExitos = new ArrayCollection();
        $this->aspectosFav = new ArrayCollection();
        $this->aspectosDes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavorable(): ?bool
    {
        return $this->favorable;
    }

    public function setFavorable(bool $favorable): self
    {
        $this->favorable = $favorable;

        return $this;
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
     * @return Collection|Cuestion[]
     */
    public function getCuestiones(): Collection
    {
        return $this->cuestiones;
    }

    public function addCuestion(Cuestion $aspectoCuestion): self
    {
        if (!$this->cuestiones->contains($aspectoCuestion)) {
            $this->cuestiones[] = $aspectoCuestion;
        }

        return $this;
    }

    public function removeCuestion(Cuestion $aspectoCuestion): self
    {
        if ($this->cuestiones->contains($aspectoCuestion)) {
            $this->cuestiones->removeElement($aspectoCuestion);
        }

        return $this;
    }

    /**
     * @return Collection|FactoresPotencialesDeExito[]
     */
    public function getFactoresPotencialesDeExitos(): Collection
    {
        return $this->factoresPotencialesDeExitos;
    }

    public function addFactoresPotencialesDeExito(FactoresPotencialesDeExito $factoresPotencialesDeExito): self
    {
        if (!$this->factoresPotencialesDeExitos->contains($factoresPotencialesDeExito)) {
            $this->factoresPotencialesDeExitos[] = $factoresPotencialesDeExito;
            $factoresPotencialesDeExito->addAspecto($this);
        }

        return $this;
    }

    public function removeFactoresPotencialesDeExito(FactoresPotencialesDeExito $factoresPotencialesDeExito): self
    {
        if ($this->factoresPotencialesDeExitos->contains($factoresPotencialesDeExito)) {
            $this->factoresPotencialesDeExitos->removeElement($factoresPotencialesDeExito);
            $factoresPotencialesDeExito->removeAspecto($this);
        }

        return $this;
    }

    /**
     * @return Collection|FactoresPotencialesDeExito[]
     */
    public function getAspectosFav(): Collection
    {
        return $this->aspectosFav;
    }

    public function addAspectosFav(FactoresPotencialesDeExito $aspectosFav): self
    {
        if (!$this->aspectosFav->contains($aspectosFav)) {
            $this->aspectosFav[] = $aspectosFav;
            $aspectosFav->addAspectosFav($this);
        }

        return $this;
    }

    public function removeAspectosFav(FactoresPotencialesDeExito $aspectosFav): self
    {
        if ($this->aspectosFav->contains($aspectosFav)) {
            $this->aspectosFav->removeElement($aspectosFav);
            $aspectosFav->removeAspectosFav($this);
        }

        return $this;
    }

    /**
     * @return Collection|FactoresPotencialesDeExito[]
     */
    public function getAspectosDes(): Collection
    {
        return $this->aspectosDes;
    }

    public function addAspectosDes(FactoresPotencialesDeExito $aspectosDe): self
    {
        if (!$this->aspectosDes->contains($aspectosDe)) {
            $this->aspectosDes[] = $aspectosDe;
            $aspectosDe->addAspectosDe($this);
        }

        return $this;
    }

    public function removeAspectosDes(FactoresPotencialesDeExito $aspectosDe): self
    {
        if ($this->aspectosDes->contains($aspectosDe)) {
            $this->aspectosDes->removeElement($aspectosDe);
            $aspectosDe->removeAspectosDe($this);
        }

        return $this;
    }
}
