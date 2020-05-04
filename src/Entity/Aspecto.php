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

    public function __construct()
    {
        $this->cuestiones = new ArrayCollection();
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
}
