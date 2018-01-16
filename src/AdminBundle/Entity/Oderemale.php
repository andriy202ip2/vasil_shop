<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oderemale
 *
 * @ORM\Table(name="oderemale")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\OderemaleRepository")
 */
class Oderemale
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="oderemale", type="text")
     */
    private $oderemale;

    /**
     * @var datetime_immutable
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set oderemale
     *
     * @param string $oderemale
     *
     * @return Oderemale
     */
    public function setOderemale($oderemale)
    {
        $this->oderemale = $oderemale;

        return $this;
    }

    /**
     * Get oderemale
     *
     * @return string
     */
    public function getOderemale()
    {
        return $this->oderemale;
    }

    /**
     * Set data
     *
     * @param datetime_immutable $data
     *
     * @return Oderemale
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return datetime_immutable
     */
    public function getData()
    {
        return $this->data;
    }
}

