<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Filter\SearchFilter;


/**
 * @ODM\EmbeddedDocument
 */
#[
    ApiResource(
        collectionOperations: ['get', 'post'],
        itemOperations: ['get', 'put', 'put', 'patch']
    ),
    ApiFilter(SearchFilter::class, properties: ['name' => SearchFilter::STRATEGY_PARTIAL])
]
class Product
{
    /**
     *  @ODM\Id(type="string")
     */
    protected $id;

    /**
     * @ODM\Field(type="string")
     */
    #[Assert\NotBlank]
    protected $name;

    /**
     * @ODM\Field(type="float")
     */
    protected $price;

    /**
     * @ODM\ReferenceOne(targetDocument=Company::class, inversedBy="products", storeAs="id")
     */
    public $company;


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
