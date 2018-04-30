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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize()
    {
        return $this->imageSize;
    }

}
