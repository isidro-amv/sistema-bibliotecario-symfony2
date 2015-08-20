<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\UserBundle\Entity\Municipality
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Entity\MunicipalityRepository")
 */
class municipality
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
     * @var string $municipality
     *
     * @ORM\Column(name="municipality", type="string", length=255)
     */
    private $municipality;

    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="municipality")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     * @return integer
     */
    private $state_id;


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
     * Set municipality
     *
     * @param string $municipality
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;
    }

    /**
     * Get municipality
     *
     * @return string 
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * Set state_id
     *
     * @param Acme\UserBundle\Entity\State $stateId
     */
    public function setStateId(\Acme\UserBundle\Entity\State $stateId)
    {
        $this->state_id = $stateId;
    }

    /**
     * Get state_id
     *
     * @return Acme\UserBundle\Entity\State 
     */
    public function getStateId()
    {
        return $this->state_id;
    }
}