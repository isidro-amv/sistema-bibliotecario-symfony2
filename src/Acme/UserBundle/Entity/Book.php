<?php

namespace Acme\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\BookRepository")
 */
class book
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
     * @var integer $hits
     *
     * @ORM\Column(name="hits", type="integer")
     */
    private $hits;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer")
     * 
     */
    private $cantidad;

    /**
     * @var string $clasificacion
     *
     * @ORM\Column(name="clasificacion", type="string", length=255, nullable=true)
     */
    private $clasificacion = null;

    /**
     * @var integer $precio
     *
     * @ORM\Column(name="precio", type="integer", nullable=true)
     */
    private $precio = null;

    /**
     * @var string $signatura_topografica
     *
     * @ORM\Column(name="signatura_topografica", type="string", length=255)
     */
    private $signatura_topografica = null;

    /**
     * @var string $tema
     *
     * @ORM\Column(name="tema", type="string", length=255, nullable=true)
     */
    private $tema = null;

    /**
     * @var string $editorial
     *
     * @ORM\Column(name="editorial", type="string", length=255, nullable=true)
     */
    private $editorial = null;

    /**
     * @var string $lugar_publicacion
     *
     * @ORM\Column(name="lugar_publicacion", type="string", length=255, nullable=true)
     */
    private $lugar_publicacion = null;

    /**
     * @var date $fecha_edicion
     *
     * @ORM\Column(name="fecha_edicion", type="date", nullable=true)
     */
    private $fecha_edicion = null;

    /**
     * @var string $idioma
     *
     * @ORM\Column(name="idioma", type="string", length=255, nullable=true)
     */
    private $idioma = null;

    /**
     * @var string $tamano
     *
     * @ORM\Column(name="tamano", type="string", length=255, nullable=true)
     */
    private $tamano = null;

    /**
     * @var string $descrip_fisica
     *
     * @ORM\Column(name="descrip_fisica", type="string", length=255, nullable=true)
     */
    private $descrip_fisica = null;

    /**
     * @var string $formato
     *
     * @ORM\Column(name="formato", type="string", length=255, nullable=true)
     */
    private $formato = null;

    /**
     * @var string $notas
     *
     * @ORM\Column(name="notas", type="string", length=255, nullable=true)
     */
    private $notas = null;

    /**
     * @var string $isbn
     *
     * @ORM\Column(name="isbn", type="string", length=255, nullable=true)
     */
    private $isbn=null;

    /**
     * @var string $volumen
     *
     * @ORM\Column(name="volumen", type="string", length=255, nullable=true)
     */
    private $volumen=null;

    /**
     * @var integer $edicion
     *
     * @ORM\Column(name="edicion", type="integer", nullable=true)
     */
    private $edicion = null;

    /**
     * @var integer $paginas
     *
     * @ORM\Column(name="paginas", type="integer", nullable=true)
     */
    private $paginas = null;

    /**
     * @var string $status_record
     *
     * @ORM\Column(name="status_record", type="string", length=255, nullable=true)
     */
    private $status_record=null;

    /**
     * @var string $estado_fisico
     *
     * @ORM\Column(name="estado_fisico", type="string", length=255, nullable=true)
     */
    private $estado_fisico=null;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $author;
     *
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="book")
     * @ORM\JoinTable(name="author_book",
     * joinColumns={@ORM\JoinColumn(name="author_id",referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="book_id",referencedColumnName="id")})
     */
    private $author;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $record;
     * @ORM\OneToMany(targetEntity="Record", mappedBy="book_id")
     * 
     */
    private $record;

    public function __construct()
    {
        $this->author = new \Doctrine\Common\Collections\ArrayCollection();
        $this->record = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitulo();
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
     * Set hits
     *
     * @param integer $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
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
     * Set signatura_topografica
     *
     * @param string $signaturaTopografica
     */
    public function setSignaturaTopografica($signaturaTopografica)
    {
        $this->signatura_topografica = $signaturaTopografica;
    }

    /**
     * Get signatura_topografica
     *
     * @return string 
     */
    public function getSignaturaTopografica()
    {
        return $this->signatura_topografica;
    }

    /**
     * Set tema
     *
     * @param string $tema
     */
    public function setTema($tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return string 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set editorial
     *
     * @param string $editorial
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    /**
     * Get editorial
     *
     * @return string 
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set lugar_publicacion
     *
     * @param string $lugarPublicacion
     */
    public function setLugarPublicacion($lugarPublicacion)
    {
        $this->lugar_publicacion = $lugarPublicacion;
    }

    /**
     * Get lugar_publicacion
     *
     * @return string 
     */
    public function getLugarPublicacion()
    {
        return $this->lugar_publicacion;
    }

    /**
     * Set fecha_edicion
     *
     * @param date $fechaEdicion
     */
    public function setFechaEdicion($fechaEdicion)
    {
        $this->fecha_edicion = $fechaEdicion;
    }

    /**
     * Get fecha_edicion
     *
     * @return date 
     */
    public function getFechaEdicion()
    {
        return $this->fecha_edicion;
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
     * Set tamano
     *
     * @param string $tamano
     */
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;
    }

    /**
     * Get tamano
     *
     * @return string 
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set descrip_fisica
     *
     * @param string $descripFisica
     */
    public function setDescripFisica($descripFisica)
    {
        $this->descrip_fisica = $descripFisica;
    }

    /**
     * Get descrip_fisica
     *
     * @return string 
     */
    public function getDescripFisica()
    {
        return $this->descrip_fisica;
    }

    /**
     * Set formato
     *
     * @param string $formato
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;
    }

    /**
     * Get formato
     *
     * @return string 
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set notas
     *
     * @param string $notas
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;
    }

    /**
     * Get notas
     *
     * @return string 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set volumen
     *
     * @param string $volumen
     */
    public function setVolumen($volumen)
    {
        $this->volumen = $volumen;
    }

    /**
     * Get volumen
     *
     * @return string 
     */
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * Set edicion
     *
     * @param integer $edicion
     */
    public function setEdicion($edicion)
    {
        $this->edicion = $edicion;
    }

    /**
     * Get edicion
     *
     * @return integer 
     */
    public function getEdicion()
    {
        return $this->edicion;
    }

    /**
     * Set paginas
     *
     * @param integer $paginas
     */
    public function setPaginas($paginas)
    {
        $this->paginas = $paginas;
    }

    /**
     * Get paginas
     *
     * @return integer 
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set status_record
     *
     * @param string $statusRecord
     */
    public function setStatusRecord($statusRecord)
    {
        $this->status_record = $statusRecord;
    }

    /**
     * Get status_record
     *
     * @return string 
     */
    public function getStatusRecord()
    {
        return $this->status_record;
    }

    /**
     * Set estado_fisico
     *
     * @param string $estadoFisico
     */
    public function setEstadoFisico($estadoFisico)
    {
        $this->estado_fisico = $estadoFisico;
    }

    /**
     * Get estado_fisico
     *
     * @return string 
     */
    public function getEstadoFisico()
    {
        return $this->estado_fisico;
    }

    /**
     * Add author
     *
     * @param Acme\UserBundle\Entity\Author $author
     */
    public function addAuthor(\Acme\UserBundle\Entity\Author $author)
    {
        $this->author[] = $author;
    }

    /**
     * remove author
     *
     * @param Acme\UserBundle\Entity\Author $author
     */
    public function getAuthors()
    {
         return $this->author->toArray();;
    }

    public function removeAuthor(\Acme\UserBundle\Entity\Author $author)
    {
        $this->author->removeElement($author);
    }

    /**
     * Get author
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add record
     *
     * @param \Acme\UserBundle\Entity\Record $record
     */
    public function addRecord(\Acme\UserBundle\Entity\Record $record)
    {
        $this->record[] = $record;
    }

    /**
     * Get record
     *
     * @return \Doctrine\Common\Collections\ArrayCollection 
     */
    public function getRecord()
    {
        return $this->record;
    }
}