<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Money\Money;
use Money\Currency;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Items
 *
 * @ORM\Table(name="items", indexes={@ORM\Index(name="model_menu_id", columns={"model_menu_id"}), @ORM\Index(name="auto_menu_id", columns={"auto_menu_id"}), @ORM\Index(name="data_menu_id", columns={"data_menu_id"})})
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\ItemsRepository")
 * @Vich\Uploadable
 */
class Items {

    /**
     * @var Pictures
     *
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="item", cascade={"persist"})
     *
     */
    private $pictures;

    /**
     * @var ArrayCollection
     *
     */
    private $picturesMultiple;

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
     * @var integer
     *
     * @ORM\Column(name="price_amount", type="integer")
     */
    private $priceAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="price_currency", type="string", length=64)
     */
    private $priceCurrency;


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
        if (!$this->priceCurrency) {
            return null;
        }
        if (!$this->priceAmount) {
            return new Money(0, new Currency($this->priceCurrency));
        }
        return new Money($this->priceAmount, new Currency($this->priceCurrency));
    }

    /**
     * Set price
     *
     * @param Money $price
     * @return TestMoney
     */
    public function setPrice(Money $price)
    {
        $this->priceAmount = $price->getAmount();
        $this->priceCurrency = $price->getCurrency()->getCode();

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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set priceAmount.
     *
     * @param int $priceAmount
     *
     * @return Items
     */
    public function setPriceAmount($priceAmount)
    {
        $this->priceAmount = $priceAmount;

        return $this;
    }

    /**
     * Get priceAmount.
     *
     * @return int
     */
    public function getPriceAmount()
    {
        return $this->priceAmount;
    }

    /**
     * Set priceCurrency.
     *
     * @param string $priceCurrency
     *
     * @return Items
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    /**
     * Get priceCurrency.
     *
     * @return string
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->picturesMultiple = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setPicturesMultiple($picturesMultiple){

        /*
        $this->picturesMultiple = new \Doctrine\Common\Collections\ArrayCollection();


        foreach($picturesMultiple as $uploadedImg)
        {

            $picture = new Picture();
            $picture->setItemId($this->getId());
            $picture->getImageFile($uploadedImg);

            //var_dump($picture);
            //$this->addPicture($picture);
            $this->picturesMultiple->add($picture);
        }*/

        return $this->picturesMultiple = $picturesMultiple;
    }

    public function getPicturesMultiple(){

        return $this->picturesMultiple;
    }

    /**
     * Add picture.
     *
     * @param \Shop\MenuBundle\Entity\Picture $picture
     *
     * @return Items
     */
    public function addPicture(\Shop\MenuBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture.
     *
     * @param \Shop\MenuBundle\Entity\Picture $picture
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePicture(\Shop\MenuBundle\Entity\Picture $picture)
    {
        return $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}
