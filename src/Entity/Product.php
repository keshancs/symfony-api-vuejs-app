<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class Product
 */
#[Entity]
#[Table(name: 'product')]
class Product
{
    /**
     * @var int|null
     */
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'product_id', type: 'integer')]
    protected ?int $id;

    /**
     * @var string|null
     */
    #[Column(name: 'name', type: 'string')]
    protected ?string $name;

    /**
     * @var string|null
     */
    #[Column(name: 'slug', type: 'string', unique: true)]
    protected ?string $slug;

    /**
     * @var float|null
     */
    #[Column(name: 'price', type: 'float', precision: 15, scale: 2)]
    protected ?float $price;

    /**
     * @var Category|null
     */
    #[ManyToOne(targetEntity: Category::class)]
    #[JoinColumn(name: 'category_id', referencedColumnName: 'category_id')]
    protected ?Category $category;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Product
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     *
     * @return Product
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return Product
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}