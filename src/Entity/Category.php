<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Category
 */
#[Entity]
#[Table(name: 'category')]
class Category
{
    /**
     * @var int|null
     */
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'category_id', type: 'integer')]
    #[Groups(['default', 'breadcrumbs'])]
    protected ?int $id;

    /**
     * @var string|null
     */
    #[Column(name: 'name', type: 'string')]
    #[Groups(['default', 'breadcrumbs'])]
    protected ?string $name;

    /**
     * @var string|null
     */
    #[Column(name: 'slug', type: 'string', unique: true)]
    #[Groups(['default', 'breadcrumbs'])]
    protected ?string $slug;

    /**
     * @var string|null
     */
    #[Column(name: 'icon', type: 'string')]
    #[Groups(['default', 'breadcrumbs'])]
    protected ?string $icon;

    /**
     * @var Category|null
     */
    #[ManyToOne(targetEntity: Category::class, inversedBy: 'children')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'category_id')]
    #[Groups(['breadcrumbs'])]
    protected ?Category $parent;

    /**
     * @var Collection
     */
    #[OneToMany(mappedBy: 'parent', targetEntity: Category::class)]
    #[JoinColumn(referencedColumnName: 'category_id')]
    #[Groups(['default'])]
    protected Collection $children;

    /**
     * Constructor.
     */
    #[Pure] public function __construct()
    {
        $this->children = new ArrayCollection();
    }

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
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name): self
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
     * @return Category
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     *
     * @return Category
     */
    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getParent(): ?Category
    {
        return $this->parent;
    }

    /**
     * @param Category|null $parent
     *
     * @return Category
     */
    public function setParent(?Category $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     *
     * @return Category
     */
    public function setChildren(Collection $children): self
    {
        $this->children = $children;

        return $this;
    }
}
