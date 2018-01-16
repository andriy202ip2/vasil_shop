<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sendemale
 *
 * @ORM\Table(name="sendemale")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\SendemaleRepository")
 */
class Sendemale
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
     * @ORM\Column(name="sendemale", type="text")
     */
    private $sendemale;

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
     * Set sendemale
     *
     * @param string $sendemale
     *
     * @return Sendemale
     */
    public function setSendemale($sendemale)
    {
        $this->sendemale = $sendemale;

        return $this;
    }

    /**
     * Get sendemale
     *
     * @return string
     */
    public function getSendemale()
    {
        return $this->sendemale;
    }

    /**
     * Set data
     *
     * @param datetime_immutable $data
     *
     * @return Sendemale
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

