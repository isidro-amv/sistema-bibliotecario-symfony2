<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="acme_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection() $Record
     * @ORM\OneToMany(targetEntity="Record", mappedBy="admin_entrega")
     */
    private $Record;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="user")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true)
     * @return integer
     */
    private $address_id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="Ingrese su nombre porfavor.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    private $nombre;

    /**
     * @var string $apellido_paterno
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Apellido Paterno", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    private $apellido_paterno;

    /**
     * @var string $apellido_materno
     *
     * @ORM\Column(name="apellido_materno", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Apellido Materno", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    private $apellido_materno;

    /**
     * @var string $puesto
     *
     * @ORM\Column(name="puesto", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Puesto", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    private $puesto;

    /**
     * @var date $fecha_nacimiento
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fecha_nacimiento;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function removeRoles($roles){
        foreach ($roles as $key => $role) {
            $this->removeRole($role);
        }
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido_paterno
     *
     * @param string $apellidoPaterno
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellido_paterno = $apellidoPaterno;
    }

    /**
     * Get apellido_paterno
     *
     * @return string 
     */
    public function getApellidoPaterno()
    {
        return $this->apellido_paterno;
    }

    /**
     * Set apellido_materno
     *
     * @param string $apellidoMaterno
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellido_materno = $apellidoMaterno;
    }

    /**
     * Get apellido_materno
     *
     * @return string 
     */
    public function getApellidoMaterno()
    {
        return $this->apellido_materno;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * Get puesto
     *
     * @return string 
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param date $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return date 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set fecha_registro
     *
     * @param date $fecha_registro
     */
    public function setFechaRegistri($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    /**
     * Get fecha_registro
     *
     * @return date 
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * Add Record
     *
     * @param Acme\UserBundle\Entity\Record $record
     */
    public function addRecord(\Acme\UserBundle\Entity\Record $record)
    {
        $this->Record[] = $record;
    }

    /**
     * Get Record
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecord()
    {
        return $this->Record;
    }

    /**
     * Set address_id
     *
     * @param Acme\UserBundle\Entity\Address $addressId
     */
    public function setAddressId(\Acme\UserBundle\Entity\Address $addressId)
    {
        $this->address_id = $addressId;
    }

    /**
     * Get address_id
     *
     * @return Acme\UserBundle\Entity\Address 
     */
    public function getAddressId()
    {
        return $this->address_id;
    }
}