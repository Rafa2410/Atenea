<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioUnidadPermisoRepository")
 */
class UsuarioUnidadPermiso
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Permisos", inversedBy="usuarioUnidadPermisos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $permiso;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="usuarioUnidadPermisos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadDeGestion", inversedBy="usuarioUnidadPermisos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $unidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPermiso(): ?Permisos
    {
        return $this->permiso;
    }

    public function setPermiso(?Permisos $permiso): self
    {
        $this->permiso = $permiso;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getUnidad(): ?UnidadDeGestion
    {
        return $this->unidad;
    }

    public function setUnidad(?UnidadDeGestion $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }
}
