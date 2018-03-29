<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ThreeRubric
 *
 * @ORM\Table(name="three_rubric")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\ThreeRubricRepository")
 */
class ThreeRubric
{
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="ThreeRubric")
     */    
    private $products;
    
    /**
     * @ORM\ManyToOne(targetEntity="TwoRubric", inversedBy="three_rubric")
     * @ORM\JoinColumn(name="two_rubric_id", referencedColumnName="id")
     */
    private $twoRubric;
    
    /**
     * @ORM\ManyToOne(targetEntity="OneRubric", inversedBy="two_rubric")
     * @ORM\JoinColumn(name="one_rubric_id", referencedColumnName="id")
     */
    private $oneRubric;
        
    /**
     * @var integer
     *
     * @ORM\Column(name="one_rubric_id", type="integer", nullable=true)
     */
    private $oneRubricId;

    /**
     * @var integer
     *
     * @ORM\Column(name="two_rubric_id", type="integer", nullable=true)
     */
    private $twoRubricId;

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
        $this->products = new ArrayCollection();
    }    
    
    public function getProducts()
    {
        return $this->products;
    }
    
    public function getTwoRubric()
    {
        return $this->twoRubric;
    }
    
    public function setTwoRubric(\Shop\MenuBundle\Entity\TwoRubric $twoRubric = null)
    {
        $this->twoRubric = $twoRubric;

        return $this;
    }

    public function getOneRubric()
    {
        return $this->oneRubric;
    }
    
    public function setOneRubric(\Shop\MenuBundle\Entity\OneRubric $oneRubric = null)
    {
        $this->oneRubric = $oneRubric;

        return $this;
    }    
    
    /**
     * Set modelMenuId
     *
     * @param integer $oneRubricId
     *
     * @return ThreeRubric
     */
    public function setOneRubricId($oneRubricId)
    {
        $this->oneRubricId = $oneRubricId;

        return $this;
    }

    /**
     * Get modelMenuId
     *
     * @return integer
     */
    public function getOneRubricId()
    {
        return $this->oneRubricId;
    }

    /**
     * Set autoMenuId
     *
     * @param integer $twoRubricId
     *
     * @return ThreeRubric
     */
    public function setTwoRubricId($twoRubricId)
    {
        $this->twoRubricId = $twoRubricId;

        return $this;
    }

    /**
     * Get autoMenuId
     *
     * @return integer
     */
    public function getTwoRubricId()
    {
        return $this->twoRubricId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ThreeRubric
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
