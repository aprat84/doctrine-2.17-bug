<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\OneToMany(
        mappedBy: 'product',
        targetEntity: ProductTranslation::class,
        cascade: ['persist', 'merge',],
        fetch: 'EAGER',
        indexBy: 'language_id'
    )]
    private Collection $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Collection<string, ProductTranslation>
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection<string, ProductTranslation> $translations
     * @return $this
     */
    public function setTranslations(Collection $translations): Product
    {
        $this->translations = new ArrayCollection();

        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }

        return $this;
    }

    public function addTranslation(ProductTranslation $translation): Product
    {
        $this->translations->set($translation->getLanguage()->getId(), $translation);
        $translation->setProduct($this);
        return $this;
    }

    public function getTranslation(string $languageId): ?ProductTranslation
    {
        return $this->translations->get($languageId);
    }

    public function removeTranslation(ProductTranslation $translation): Product
    {
        $this->translations->removeElement($translation);
        return $this;
    }
}
