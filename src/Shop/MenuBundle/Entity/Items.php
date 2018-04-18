<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Money\Money;

/**
 * Items
 *
 * @ORM\Table(name="items", indexes={@ORM\Index(name="model_menu_id", columns={"model_menu_id"}), @ORM\Index(name="auto_menu_id", columns={"auto_menu_id"}), @ORM\Index(name="data_menu_id", columns={"data_menu_id"})})
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\ItemsRepository")
 */
class Items {

    /**
     * @ORM\ManyToOne(targetEntity="DataMenu", inversedBy="items")
     * @ORM\JoinColumn(name="data_menu_id", referencedColumnName="id")
     */
    private $data;

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
     * @var Money
     *
     * @ORM\Column(name="price", type="money", nullable=true)
     */
    private $price;    
    
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
     * @var integer
     *
     * @ORM\Column(name="data_menu_id", type="integer", nullable=false)
     */
    private $dataMenuId;

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
    
    public function getData() {
        return $this->data;
    }

    public function setData(\Shop\MenuBundle\Entity\DataMenu $data = null) {
        $this->data = $data;

        return $this;
    }

    public function getAuto() {
        return $this->auto;
    }

    public function setAuto(\Shop\MenuBundle\Entity\AutoMenu $auto = null) {
        $this->auto = $auto;

        return $this;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel(\Shop\MenuBundle\Entity\ModelMenu $model = null) {
        $this->model = $model;

        return $this;
    }

    /**
     * Set modelMenuId
     *
     * @param integer $modelMenuId
     *
     * @return Items
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
     * Set autoMenuId
     *
     * @param integer $autoMenuId
     *
     * @return Items
     */
    public function setAutoMenuId($autoMenuId) {
        $this->autoMenuId = $autoMenuId;

        return $this;
    }

    /**
     * Get autoMenuId
     *
     * @return integer
     */
    public function getAutoMenuId() {
        return $this->autoMenuId;
    }

    /**
     * Set dataMenuId
     *
     * @param integer $dataMenuId
     *
     * @return Items
     */
    public function setDataMenuId($dataMenuId) {
        $this->dataMenuId = $dataMenuId;

        return $this;
    }

    /**
     * Get dataMenuId
     *
     * @return integer
     */
    public function getDataMenuId() {
        return $this->dataMenuId;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Items
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
     * @return Items
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
     * Set img
     *
     * @param string $img
     *
     * @return Items
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function saveImg(Items $item, $img_directory, $img = NULL) {

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
