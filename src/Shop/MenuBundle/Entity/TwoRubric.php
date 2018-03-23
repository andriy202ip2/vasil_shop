<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TwoRubric
 *
 * @ORM\Table(name="two_rubric")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\TwoRubricRepository")
 */
class TwoRubric
{
    /**
     * @ORM\ManyToOne(targetEntity="OneRubric", inversedBy="two_rubric")
     * @ORM\JoinColumn(name="one_rubric_id", referencedColumnName="id")
     */
    private $oneRubric;
    
    
    /**
     * @ORM\OneToMany(targetEntity="ThreeRubric", mappedBy="two_rubric")
     */    
    private $threeRubrics;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="one_rubric_id", type="integer", nullable=false)
     */
    private $oneRubricId;

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
        $this->threeRubrics = new ArrayCollection();
    }    
    
    public function getThreeRubrics()
    {
        return $this->threeRubrics;
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
     * @return TwoRubric
     */
    public function setOneRubricId($oneRubricId) {
        $this->oneRubricId = $oneRubricId;

        return $this;
    }

    /**
     * Get modelMenuId
     *
     * @return integer
     */
    public function getOneRubricId() {
        return $this->oneRubricId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TwoRubric 
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
