<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoCuestionRepository")
 */
class TipoCuestion
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
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubtipoCuestion", mappedBy="tipo")
     */
    private $subtipoCuestions;

    public function __construct()
    {
        $this->subtipoCuestions = new ArrayCollection();
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
     * @return Collection|SubtipoCuestion[]
     */
    public function getSubtipoCuestions(): Collection
    {
        return $this->subtipoCuestions;
    }

    public function addSubtipoCuestion(SubtipoCuestion $subtipoCuestion): self
    {
        if (!$this->subtipoCuestions->contains($subtipoCuestion)) {
            $this->subtipoCuestions[] = $subtipoCuestion;
            $subtipoCuestion->setTipo($this);
        }

        return $this;
    }

    public function removeSubtipoCuestion(SubtipoCuestion $subtipoCuestion): self
    {
        if ($this->subtipoCuestions->contains($subtipoCuestion)) {
            $this->subtipoCuestions->removeElement($subtipoCuestion);
            // set the owning side to null (unless already changed)
            if ($subtipoCuestion->getTipo() === $this) {
                $subtipoCuestion->setTipo(null);
            }
        }

        return $this;
    }
}
