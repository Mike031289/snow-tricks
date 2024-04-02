<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video extends Media
{
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'L\'URL ne peut pas être vide')]
    protected ?string $url = null;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?Trick $trick = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

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

