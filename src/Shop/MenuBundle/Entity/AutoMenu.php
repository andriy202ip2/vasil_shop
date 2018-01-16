<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AutoMenu
 *
 * @ORM\Table(name="auto_menu")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\AutoMenuRepository")
 */
class AutoMenu {

    /**
     * @ORM\ManyToOne(targetEntity="ModelMenu", inversedBy="autos")
     * @ORM\JoinColumn(name="model_menu_id", referencedColumnName="id")
     */
    private $model;
    
    
    /**
     * @ORM\OneToMany(targetEntity="DataMenu", mappedBy="auto")
     */    
    private $datas;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="model_menu_id", type="integer", nullable=false)
     */
    private $modelMenuId;

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
        $this->datas = new ArrayCollection();
    }    
    
    public function getDatas()
    {
        return $this->datas;
    }
    
    public function getModel()
    {
        return $this->model;
    }
    
    public function setModel(\Shop\MenuBundle\Entity\ModelMenu $model = null)
    {
        $this->model = $model;

        return $this;
    }
    
    /**
     * Set modelMenuId
     *
     * @param integer $modelMenuId
     *
     * @return AutoMenu
     */
    public function setModelMenuId($modelMenuId) {
        $this->modelMenuId = $modelMenuId;

        return $this;
    }

    /**
     * Get modelMenuId
     *
     * @return integer
     */
    public function getModelMenuId() {
        return $this->modelMenuId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AutoMenu
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
