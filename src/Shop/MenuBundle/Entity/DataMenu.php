<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DataMenu
 *
 * @ORM\Table(name="data_menu")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\DataMenuRepository")
 */
class DataMenu
{
    
    /**
     * @ORM\OneToMany(targetEntity="Items", mappedBy="data")
     */    
    private $items;
    
    /**
     * @ORM\ManyToOne(targetEntity="AutoMenu", inversedBy="datas")
     * @ORM\JoinColumn(name="auto_menu_id", referencedColumnName="id")
     */
    private $auto;
    
    /**
     * @ORM\ManyToOne(targetEntity="ModelMenu", inversedBy="autos")
     * @ORM\JoinColumn(name="model_menu_id", referencedColumnName="id")
     */
    private $model;
        
    /**
     * @var integer
     *
     * @ORM\Column(name="model_menu_id", type="integer", nullable=false)
     */
    private $modelMenuId;

    /**
     * @var integer
     *
     * @ORM\Column(name="auto_menu_id", type="integer", nullable=false)
     */
    private $autoMenuId;

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
        $this->items = new ArrayCollection();
    }    
    
    public function getItems()
    {
        return $this->items;
    }
    
    public function getAuto()
    {
        return $this->auto;
    }
    
    public function setAuto(\Shop\MenuBundle\Entity\AutoMenu $auto = null)
    {
        $this->auto = $auto;

        return $this;
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
     * @return DataMenu
     */
    public function setModelMenuId($modelMenuId)
    {
        $this->modelMenuId = $modelMenuId;

        return $this;
    }

    /**
     * Get modelMenuId
     *
     * @return integer
     */
    public function getModelMenuId()
    {
        return $this->modelMenuId;
    }

    /**
     * Set autoMenuId
     *
     * @param integer $autoMenuId
     *
     * @return DataMenu
     */
    public function setAutoMenuId($autoMenuId)
    {
        $this->autoMenuId = $autoMenuId;

        return $this;
    }

    /**
     * Get autoMenuId
     *
     * @return integer
     */
    public function getAutoMenuId()
    {
        return $this->autoMenuId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DataMenu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
}
