<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Phone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\phoneRepository")
 */
class phone
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
     * @var string $celular
     *
     * @ORM\Column(name="celular", type="string", length=255, nullable=true)
     */
    private $celular;

    /**
     * @var string $telefono_1
     *
     * @ORM\Column(name="telefono_1", type="string", length=255, nullable=true)
     */
    private $telefono_1;

    /**
     * @var string $telefono_2
     *
     * @ORM\Column(name="telefono_2", type="string", length=255, nullable=true)
     */
    private $telefono_2;


    public function __toString()
    {
        $this->getCelular();
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
     * Set celular
     *
     * @param string $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set telefono_1
     *
     * @param string $telefono1
     */
    public function setTelefono1($telefono1)
    {
        $this->telefono_1 = $telefono1;
    }

    /**
     * Get telefono_1
     *
     * @return string 
     */
    public function getTelefono1()
    {
        return $this->telefono_1;
    }

    /**
     * Set telefono_2
     *
     * @param string $telefono2
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono_2 = $telefono2;
    }

    /**
     * Get telefono_2
     *
     * @return string 
     */
    public function getTelefono2()
    {
        return $this->telefono_2;
    }
}