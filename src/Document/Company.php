<?php

namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Filter\OrderFilter;

/**
 * @ODM\Document
 */
#[
    ApiResource(
        collectionOperations: ['get', 'post'],
        itemOperations: ['get', 'put', 'put', 'patch'],
        attributes: ['pagination_items_per_page' => 5]
    ),
    ApiFilter(
        OrderFilter::class,
        properties: ['issueDate' => 'DESC']
    )
]
class Company
{
    /**
     *  @ODM\Id(type="string")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    #[Assert\NotBlank]
    public $name;

    /**
     * @ODM\Field(type="string")
     */
    public $address;

    /**
     * @ODM\Field(type="string")
     */
    public $cuntryCode;

    /**
     * @ODM\Field(type="date")
     */
    #[Assert\NotNull]
    public $issueDate;

    /**
     * @ODM\ReferenceMany(targetDocument=Product::class, mappedBy="company", cascade={"persist"}, storeAs="id")
     * @ODM\EmbedMany(targetDocument=Product::class)
     */
    public $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function addProduct(Product $product): void
    {
        $product->product = $this;
        $this->products->add($product);
    }

    public function removeProduct(Product $product): void
    {
        $product->product = null;
        $this->products->removeElement($product);
    }




    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return ?string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param ?string $address
     *
     * @return self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of cuntryCode
     *
     * @return string
     */
    public function getCuntryCode(): string
    {
        return $this->cuntryCode;
    }

    /**
     * Set the value of cuntryCode
     *
     * @param string $cuntryCode
     *
     * @return self
     */
    public function setCuntryCode(string $cuntryCode): self
    {
        $this->cuntryCode = $cuntryCode;

        return $this;
    }

    /**
     * Get the value of issueDate
     *
     * @return string
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Set the value of issueDate
     *
     * @param string $issueDate
     *
     * @return self
     */
    public function setIssueDate(\DateTime $issueDate): self
    {
        $this->issueDate = $issueDate;

        return $this;
    }
}
