<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture extends Media
{

    #[ORM\Column(type: 'string')]
    protected ?string $path= null;

    /**
     * Get the value of path
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
