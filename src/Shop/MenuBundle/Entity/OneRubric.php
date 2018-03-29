<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OneRubric
 *
 * @ORM\Table(name="one_rubric")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\OneRubricRepository")
 */
class OneRubric
{
    /**
     * @ORM\OneToMany(targetEntity="TwoRubric", mappedBy="one_rubric")
     */
    private $twoRubrics;
    
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
        $this->twoRubrics = new ArrayCollection();
    }
    
    public function getTwoRubrics()
    {
        return $this->twoRubrics;
    }
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return OneRubric
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
