<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermisosRepository")
 */
class Permisos
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
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioUnidadPermiso", mappedBy="permiso")
     */
    private $usuarioUnidadPermisos;

    public function __construct()
    {
        $this->usuarioUnidadPermisos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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
            $usuarioUnidadPermiso->setPermiso($this);
        }

        return $this;
    }

    public function removeUsuarioUnidadPermiso(UsuarioUnidadPermiso $usuarioUnidadPermiso): self
    {
        if ($this->usuarioUnidadPermisos->contains($usuarioUnidadPermiso)) {
            $this->usuarioUnidadPermisos->removeElement($usuarioUnidadPermiso);
            // set the owning side to null (unless already changed)
            if ($usuarioUnidadPermiso->getPermiso() === $this) {
                $usuarioUnidadPermiso->setPermiso(null);
            }
        }

        return $this;
    }
}
