<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emale
 *
 * @ORM\Table(name="emale")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EmaleRepository")
 */
class Emale
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
     * @ORM\Column(name="emale", type="string", length=255)
     */
    private $emale;


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
     * Set emale
     *
     * @param string $emale
     *
     * @return Emale
     */
    public function setEmale($emale)
    {
        $this->emale = $emale;

        return $this;
    }

    /**
     * Get emale
     *
     * @return string
     */
    public function getEmale()
    {
        return $this->emale;
    }
}

