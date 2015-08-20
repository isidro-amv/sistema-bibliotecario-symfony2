<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Material
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\MaterialRepository")
 */
class material
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
     * @var string $signa_topo
     *
     * @ORM\Column(name="signa_topo", type="string", length=255)
     *
     */
    private $signa_topo;

    /**
     * @var string $autor
     *
     * @ORM\Column(name="autor", type="string", length=255)
     */
    private $autor;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer $precio
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;


    /**
     * @var string $tipo
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var string $clasificacion
     *
     * @ORM\Column(name="clasificacion", type="string", length=255)
     */
    private $clasificacion;

    /**
     * @var string $idioma
     *
     * @ORM\Column(name="idioma", type="string", length=255)
     */
    private $idioma;

    /**
     * @var string $nota
     *
     * @ORM\Column(name="nota", type="string", length=255)
     */
    private $nota;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $recordMaterial;
     * @ORM\OneToMany(targetEntity="RecordMaterial", mappedBy="material_id")
     * 
     */
    private $recordMaterial;

    public function __construct()
    {
        $this->recordMaterial = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        $this->getNombre();
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
     * Set precio
     *
     * @param integer $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set clasificacion
     *
     * @param string $clasificacion
     */
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }

    /**
     * Get clasificacion
     *
     * @return string 
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set nota
     *
     * @param string $nota
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    /**
     * Add recordMaterial
     *
     * @param Acme\UserBundle\Entity\RecordMaterial $recordMaterial
     */
    public function addRecordMaterial(\Acme\UserBundle\Entity\RecordMaterial $recordMaterial)
    {
        $this->recordMaterial[] = $recordMaterial;
    }

    /**
     * Get recordMaterial
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecordMaterial()
    {
        return $this->recordMaterial;
    }

    /**
     * Set autor
     *
     * @param string $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }


    /**
     * Set signa_topo
     *
     * @param string $signaTopo
     */
    public function setSignaTopo($signaTopo)
    {
        $this->signa_topo = $signaTopo;
    }

    /**
     * Get signa_topo
     *
     * @return string 
     */
    public function getSignaTopo()
    {
        return $this->signa_topo;
    }
}