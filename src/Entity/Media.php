<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    // #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'medias')]
    // #[ORM\JoinColumn(nullable: false)]
    // protected ?Trick $trick = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]
    #[Assert\Length(max: 255, maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères')]
    protected ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // /**
    //  * Get the value of trick
    //  */
    // public function getTrick(): ?Trick
    // {
    //     return $this->trick;
    // }

    // /**
    //  * Set the value of trick
    //  */
    // public function setTrick(?Trick $trick): self
    // {
    //     $this->trick = $trick;

    //     return $this;
    // }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
