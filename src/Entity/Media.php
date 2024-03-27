<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['picture' => Picture::class, 'video' => Video::class])] 
#[ORM\Entity(repositoryClass: MediaRepository::class)]

abstract class Media 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?Trick $trick = null;

    #[ORM\Column(length: 255)]
    protected ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
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
