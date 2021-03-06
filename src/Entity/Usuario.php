<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\Length(
     *     max=9,
     *     maxMessage = "No puede tener mas de 9 caracteres!",
     * )
     */
    private $telefono;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_baja;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioUnidadPermiso", mappedBy="usuario", cascade={"persist", "remove"})
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = '';

        //return (string) $this->roles;
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

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
     * @return Collection|UsuarioUnidadPermiso[]
     */
    public function getUsuarioUnidadPermisos(): Collection
    {
        return $this->usuarioUnidadPermisos;
    }

    public function addUsuarioUnidadPermiso(UsuarioUnidadPermiso $usuarioUnidadPermiso): self
    {
        if ( ! $this->usuarioUnidadPermisos->contains($usuarioUnidadPermiso)) {
            $this->usuarioUnidadPermisos[] = $usuarioUnidadPermiso;
            $usuarioUnidadPermiso->setUsuario($this);
        }

        return $this;
    }

    public function removeUsuarioUnidadPermiso(UsuarioUnidadPermiso $usuarioUnidadPermiso): self
    {
        if ($this->usuarioUnidadPermisos->contains($usuarioUnidadPermiso)) {
            $this->usuarioUnidadPermisos->removeElement($usuarioUnidadPermiso);
            // set the owning side to null (unless already changed)
            if ($usuarioUnidadPermiso->getUsuario() === $this) {
                $usuarioUnidadPermiso->setUsuario(null);
            }
        }

        return $this;
    }
}
