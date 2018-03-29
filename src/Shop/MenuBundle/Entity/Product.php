<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Money\Money;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\ManyToOne(targetEntity="ThreeRubric", inversedBy="product")
     * @ORM\JoinColumn(name="three_rubric_id", referencedColumnName="id")
     */
    private $threeRubric;

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
     * @var Money
     *
     * @ORM\Column(name="price", type="money", nullable=true)
     */
    private $price;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="one_rubric_id", type="integer", nullable=false)
     */
    private $oneRubricId;

    /**
     * @var integer
     *
     * @ORM\Column(name="two_rubric_id", type="integer", nullable=false)
     */
    private $twoRubricId;

    /**
     * @var integer
     *
     * @ORM\Column(name="three_rubric_id", type="integer", nullable=false)
     */
    private $threeRubricId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="side_id", type="smallint", nullable=false)
     */
    private $sideId;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text", length=65535, nullable=false)
     */
    private $details;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="item_id", type="string", length=256, nullable=false)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="side", type="text", length=65535, nullable=false)
     */
    private $side;

    /**
     * @var string
     *
     * @ORM\Column(name="fit", type="text", length=65535, nullable=false)
     */
    private $fit;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=256, nullable=true)
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     maxSizeMessage = "Максимальний розмір файлю має бути 2MB.",
     *     mimeTypesMessage = "Тільки малюнки дозволено загружати."
     * )
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="img_data", type="text", length=65535, nullable=false)
     */
    private $imgData;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * get Money
     *
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param Money $price
     * @return TestMoney
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;
        return $this;
    }    
    
    public function getThreeRubric() {
        return $this->threeRubric;
    }

    public function setThreeRubric(\Shop\MenuBundle\Entity\ThreeRubric $ThreeRubric = null) {
        $this->threeRubric = $ThreeRubric;

        return $this;
    }

    public function getTwoRubric() {
        return $this->twoRubric;
    }

    public function setTwoRubric(\Shop\MenuBundle\Entity\TwoRubric $TwoRubric = null) {
        $this->twoRubric = $TwoRubric;

        return $this;
    }

    public function getOneRubric() {
        return $this->oneRubric;
    }

    public function setOneRubric(\Shop\MenuBundle\Entity\OneRubric $OneRubric = null) {
        $this->oneRubric = $OneRubric;

        return $this;
    }

    /**
     * Set modelMenuId
     *
     * @param integer $OneRubricId
     *
     * @return Products
     */
    public function setOneRubricId($OneRubricId) {
        $this->oneRubricId = $OneRubricId;

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
     * Set autoMenuId
     *
     * @param integer $TwoRubricId
     *
     * @return Products
     */
    public function setTwoRubricId($TwoRubricId) {
        $this->twoRubricId = $TwoRubricId;

        return $this;
    }

    /**
     * Get autoMenuId
     *
     * @return integer
     */
    public function getTwoRubricId() {
        return $this->twoRubricId;
    }

    /**
     * Set dataMenuId
     *
     * @param integer $ThreeRubricId
     *
     * @return Products
     */
    public function setThreeRubricId($ThreeRubricId) {
        $this->threeRubricId = $ThreeRubricId;

        return $this;
    }

    /**
     * Get dataMenuId
     *
     * @return integer
     */
    public function getThreeRubricId() {
        return $this->threeRubricId;
    }

    /**
     * Set sideId
     *
     * @param boolean $sideId
     *
     * @return Products
     */
    public function setSideId($sideId) {
        $this->sideId = $sideId;

        return $this;
    }

    /**
     * Get sideId
     *
     * @return boolean
     */
    public function getSideId() {
        return $this->sideId;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Products
     */
    public function setDetails($details) {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
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
     * Set itemId
     *
     * @param string $itemId
     *
     * @return Products
     */
    public function setProductId($itemId) {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return string
     */
    public function getProductId() {
        return $this->itemId;
    }

    /**
     * Set side
     *
     * @param string $side
     *
     * @return Products
     */
    public function setSide($side) {
        $this->side = $side;

        return $this;
    }

    /**
     * Get side
     *
     * @return string
     */
    public function getSide() {
        return $this->side;
    }

    /**
     * Set fit
     *
     * @param string $fit
     *
     * @return Products
     */
    public function setFit($fit) {
        $this->fit = $fit;

        return $this;
    }

    /**
     * Get fit
     *
     * @return string
     */
    public function getFit() {
        return $this->fit;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Products
     */
    public function setImg($img) {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg() {
        return $this->img;
    }

    /**
     * Set imgData
     *
     * @param string $imgData
     *
     * @return Products
     */
    public function setImgData($imgData) {
        $this->imgData = $imgData;

        return $this;
    }

    /**
     * Get imgData
     *
     * @return string
     */
    public function getImgData() {
        return $this->imgData;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function saveImg(Products $item, $img_directory, $img = NULL) {

        $file = $item->getImg();

        if ($img != NULL && strlen($img) > 1) {
            $fileName = $img;
        } else {
            $fileName = md5(uniqid()) . '.jpeg';
        }

        $file->move(
                $img_directory, $fileName
        );

        $item->setImg($fileName);

        return $item;
    }
    
    public function removeImg($img, $img_directory) {
        if ($img != NULL && strlen($img) > 1) {
            $url = $img_directory . '/' . $img;
            if (file_exists($url)) {
                unlink($url);
            }
        }
    }
}
