<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class ProductTranslation
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Product $product;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Language $language;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name = '';

    public function __construct(Product $product, Language $language)
    {
        $this->setProduct($product);
        $this->setLanguage($language);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): ProductTranslation
    {
        $this->product = $product;
        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): ProductTranslation
    {
        $this->language = $language;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductTranslation
    {
        $this->name = $name;
        return $this;
    }
}
