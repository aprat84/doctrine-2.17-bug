<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Language
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 20)]
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): Language
    {
        $this->id = $id;
        return $this;
    }
}
