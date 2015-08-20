<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Record
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\RecordRepository")
 */
class record
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
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="record")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id",nullable=false)
     * @return integer
     */
    private $book_id;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="record")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     * @return integer
     */
    private $person_id;

    /**
     * @var integer $admin_entrega
     * @ORM\ManyToOne(targetEntity="User", inversedBy="record")
     * @ORM\JoinColumn(name="admin_entrega", referencedColumnName="id", nullable=false)
     * @return integer
     */
    private $admin_entrega;

     /**
     * @var integer $admin_recibe
     * @ORM\ManyToOne(targetEntity="User", inversedBy="record")
     * @ORM\JoinColumn(name="admin_recibe", referencedColumnName="id", nullable=true)
     * @return integer
     */
    private $admin_recibe;

    /**
     * @var date $dia_sacado
     *
     * @ORM\Column(name="dia_sacado", type="date")
     */
    private $dia_sacado;

    /**
     * @var date $dia_regreso
     *
     * @ORM\Column(name="dia_regreso", type="date")
     */
    private $dia_regreso;

    /**
     * @var date $dia_regresado
     *
     * @ORM\Column(name="dia_regresado", type="date", nullable=true)
     */
    private $dia_regresado;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="comentario", type="string", length=255, nullable=true)
     */
    private $comentario;

    /**
    * @var boolean $recibido
    *
    * @ORM\Column(name="recibido", type="boolean", nullable="true")
    */
    private $recibido = false;

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
     * Set signa_topografica
     *
     * @param string $signaTopografica
     */
    public function setSignaTopografica($signaTopografica)
    {
        $this->signa_topografica = $signaTopografica;
    }

    /**
     * Get signa_topografica
     *
     * @return string 
     */
    public function getSignaTopografica()
    {
        return $this->signa_topografica;
    }


    /**
     * Set id_persona
     *
     * @param integer $idPersona
     */
    public function setIdPersona($idPersona)
    {
        $this->id_persona = $idPersona;
    }

    /**
     * Get id_persona
     *
     * @return integer 
     */
    public function getIdPersona()
    {
        return $this->id_persona;
    }

    /**
     * Set dia_sacado
     *
     * @param date $diaSacado
     */
    public function setDiaSacado($diaSacado)
    {
        $this->dia_sacado = $diaSacado;
    }

    /**
     * Get dia_sacado
     *
     * @return date 
     */
    public function getDiaSacado()
    {
        return $this->dia_sacado;
    }

    /**
     * Set dia_regreso
     *
     * @param date $diaRegreso
     */
    public function setDiaRegreso($diaRegreso)
    {
        $this->dia_regreso = $diaRegreso;
    }

    /**
     * Get dia_regreso
     *
     * @return date 
     */
    public function getDiaRegreso()
    {
        return $this->dia_regreso;
    }

    /**
     * Set dia_regresado
     *
     * @param date $diaRegresado
     */
    public function setDiaRegresado($diaRegresado)
    {
        $this->dia_regresado = $diaRegresado;
    }

    /**
     * Get dia_regresado
     *
     * @return date 
     */
    public function getDiaRegresado()
    {
        return $this->dia_regresado;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Add person_id
     *
     * @param string $person_id
     */
    public function addPersonaId(\Acme\UserBundle\Entity\Person $personId)
    {
        $this->person_id = $personId;
    }

    /**
     * Get person_id
     *
     * @return Array 
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Add book_id
     *
     * @param string $book_id
     */
    public function addBookId(\Acme\UserBundle\Entity\Book $bookId)
    {
        $this->book_id = $bookId;
    }

    /**
     * Get persona
     *
     * @return Array 
     */
    public function getBookId()
    {
        return $this->book_id;
    }

    /**
     * Set book_id
     *
     * @param Acme\UserBundle\Entity\Book $bookId
     */
    public function setBookId(\Acme\UserBundle\Entity\Book $bookId)
    {
        $this->book_id = $bookId;
    }

    /**
     * Set person_id
     *
     * @param Acme\UserBundle\Entity\Person $personId
     */
    public function setPersonId(\Acme\UserBundle\Entity\Person $personId)
    {
        $this->person_id = $personId;
    }

    /**
     * Set recibido
     *
     * @param boolean $recibido
     */
    public function setRecibido($recibido)
    {
        $this->recibido = $recibido;
    }

    /**
     * Get recibido
     *
     * @return boolean 
     */
    public function getRecibido()
    {
        return $this->recibido;
    }

    /**
     * Set admin_entrega
     *
     * @param Acme\UserBundle\Entity\User $adminEntrega
     */
    public function setAdminEntrega(\Acme\UserBundle\Entity\User $adminEntrega)
    {
        $this->admin_entrega = $adminEntrega;
    }

    /**
     * Get admin_entrega
     *
     * @return Acme\UserBundle\Entity\User 
     */
    public function getAdminEntrega()
    {
        return $this->admin_entrega;
    }

    /**
     * Set admin_recibe
     *
     * @param Acme\UserBundle\Entity\User $adminRecibe
     */
    public function setAdminRecibe(\Acme\UserBundle\Entity\User $adminRecibe)
    {
        $this->admin_recibe = $adminRecibe;
    }

    /**
     * Get admin_recibe
     *
     * @return Acme\UserBundle\Entity\User 
     */
    public function getAdminRecibe()
    {
        return $this->admin_recibe;
    }
}