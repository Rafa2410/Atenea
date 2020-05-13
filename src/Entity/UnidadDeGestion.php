<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnidadDeGestionRepository")
 */
class UnidadDeGestion
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
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadDeGestion", inversedBy="corporacion_id", cascade={"persist", "remove"})
     */
    private $unidadDeGestion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UnidadDeGestion", mappedBy="unidadDeGestion", cascade={"persist", "remove"})
     */
    private $corporacion_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioUnidadPermiso", mappedBy="unidad", cascade={"persist", "remove"})
     */
    private $usuarioUnidadPermisos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CuestionUnidad", mappedBy="unidad")
     */
    private $cuestionUnidads;

    public function __construct()
    {
        $this->corporacion_id = new ArrayCollection();
        $this->usuarioUnidadPermisos = new ArrayCollection();
        $this->cuestionUnidads = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getUnidadDeGestion(): ?self
    {
        return $this->unidadDeGestion;
    }

    public function setUnidadDeGestion(?self $unidadDeGestion): self
    {
        $this->unidadDeGestion = $unidadDeGestion;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCorporacionId(): Collection
    {
        return $this->corporacion_id;
    }

    public function addCorporacionId(self $corporacionId): self
    {
        if (!$this->corporacion_id->contains($corporacionId)) {
            $this->corporacion_id[] = $corporacionId;
            $corporacionId->setUnidadDeGestion($this);
        }

        return $this;
    }

    public function removeCorporacionId(self $corporacionId): self
    {
        if ($this->corporacion_id->contains($corporacionId)) {
            $this->corporacion_id->removeElement($corporacionId);
            // set the owning side to null (unless already changed)
            if ($corporacionId->getUnidadDeGestion() === $this) {
                $corporacionId->setUnidadDeGestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UsuarioUnidadPermiso[]
     */
    public function getUsuarioUnidadPermisos(): Collection
    {
        return $this->usuarioUnidadPermisos;
    }

    public function addUsuarioUnidadPermiso(UsuarioUnidadPermiso $usuarioUnidadPermiso): self
    {
        if (!$this->usuarioUnidadPermisos->contains($usuarioUnidadPermiso)) {
            $this->usuarioUnidadPermisos[] = $usuarioUnidadPermiso;
            $usuarioUnidadPermiso->setUnidad($this);
        }

        return $this;
    }

    public function removeUsuarioUnidadPermiso(UsuarioUnidadPermiso $usuarioUnidadPermiso): self
    {
        if ($this->usuarioUnidadPermisos->contains($usuarioUnidadPermiso)) {
            $this->usuarioUnidadPermisos->removeElement($usuarioUnidadPermiso);
            // set the owning side to null (unless already changed)
            if ($usuarioUnidadPermiso->getUnidad() === $this) {
                $usuarioUnidadPermiso->setUnidad(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CuestionUnidad[]
     */
    public function getCuestionUnidads(): Collection
    {
        return $this->cuestionUnidads;
    }

    public function addCuestionUnidad(CuestionUnidad $cuestionUnidad): self
    {
        if (!$this->cuestionUnidads->contains($cuestionUnidad)) {
            $this->cuestionUnidads[] = $cuestionUnidad;
            $cuestionUnidad->setUnidad($this);
        }

        return $this;
    }

    public function removeCuestionUnidad(CuestionUnidad $cuestionUnidad): self
    {
        if ($this->cuestionUnidads->contains($cuestionUnidad)) {
            $this->cuestionUnidads->removeElement($cuestionUnidad);
            // set the owning side to null (unless already changed)
            if ($cuestionUnidad->getUnidad() === $this) {
                $cuestionUnidad->setUnidad(null);
            }
        }

        return $this;
    }
}
