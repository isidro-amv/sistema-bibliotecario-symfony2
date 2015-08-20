<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Address
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\AddressRepository")
 */
class address
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
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="Municipality", inversedBy="address")
     * @ORM\JoinColumn(name="municipality_id", referencedColumnName="id", nullable=false)
     * @return integer
     */
    private $municipality_id;


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
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set municipality_id
     *
     * @param Acme\UserBundle\Entity\Municipality $municipalityId
     */
    public function setMunicipalityId(\Acme\UserBundle\Entity\Municipality $municipalityId)
    {
        $this->municipality_id = $municipalityId;
    }

    /**
     * Get municipality_id
     *
     * @return Acme\UserBundle\Entity\Municipality 
     */
    public function getMunicipalityId()
    {
        return $this->municipality_id;
    }
}