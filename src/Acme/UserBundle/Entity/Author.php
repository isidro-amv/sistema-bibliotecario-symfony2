<?php

namespace Acme\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Acme\UserBundle\Entity\Book;
use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Author
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\AuthorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class author
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $apellido_paterno
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=255)
     */
    private $apellido_paterno;

    /**
     * @var string $apellido_materno
     *
     * @ORM\Column(name="apellido_materno", type="string", length=255, nullable=true)
     */
    private $apellido_materno;

    /**
     * @var string $pais
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $book;
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="author")
     *  
     */
    private $book;
    //si se desea agregar libros desde autores cambiar "mappedBy" por "inversedBy", esto funciona pero provoca
    //errores en doctrine:schema:update


    public function __construct()
    {
        $this->book = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        $nombre = $this->getNombre();
        $apellido_p = $this->getApellidoPaterno();
        $apellido_m = $this->getApellidoMaterno();  
        return "$nombre $apellido_p $apellido_m";
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
     * Set pais
     *
     * @param string $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add Book
     *
     * @param \Acme\UserBundle\Entity\Book $book
     */
    public function addBook(\Acme\UserBundle\Entity\Book $book)
    {
        $this->book[] = $book;
    }

    /**
     * Get book
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBook()
    {
        return $this->book;
    }
}