<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ModelMenu
 *
 * @ORM\Table(name="model_menu")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\ModelMenuRepository")
 */
class ModelMenu {

    /**
     * @ORM\OneToMany(targetEntity="AutoMenu", mappedBy="model")
     */
    private $autos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    
    public function __construct()
    {
        $this->autos = new ArrayCollection();
    }
    
    public function getAutos()
    {
        return $this->autos;
    }
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return ModelMenu
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    


}
