<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture extends Media
{
    #[ORM\Column(type: 'string', nullable: true)]
    protected ?string $path = null;

    protected ?UploadedFile $file = null; // New property to hold the uploaded file

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?Trick $trick = null;

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

    /**
     * Get the uploaded file
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * Set the uploaded file
     */
    public function setFile(?UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the value of trick
     */
    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    /**
     * Set the value of trick
     */
    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
    
}
