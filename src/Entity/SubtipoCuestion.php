<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubtipoCuestionRepository")
 */
class SubtipoCuestion
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
     * @ORM\OneToMany(targetEntity="App\Entity\Cuestion", mappedBy="subtipo")
     */
    private $cuestions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoCuestion", inversedBy="subtipoCuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo;

    public function __construct()
    {
        $this->cuestions = new ArrayCollection();
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
     * @return Collection|Cuestion[]
     */
    public function getCuestions(): Collection
    {
        return $this->cuestions;
    }

    public function addCuestion(Cuestion $cuestion): self
    {
        if (!$this->cuestions->contains($cuestion)) {
            $this->cuestions[] = $cuestion;
            $cuestion->setSubtipo($this);
        }

        return $this;
    }

    public function removeCuestion(Cuestion $cuestion): self
    {
        if ($this->cuestions->contains($cuestion)) {
            $this->cuestions->removeElement($cuestion);
            // set the owning side to null (unless already changed)
            if ($cuestion->getSubtipo() === $this) {
                $cuestion->setSubtipo(null);
            }
        }

        return $this;
    }

    public function getTipo(): ?TipoCuestion
    {
        return $this->tipo;
    }

    public function setTipo(?TipoCuestion $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}
