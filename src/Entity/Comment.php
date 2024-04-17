<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comment')]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank(message: 'Veuillez ajouter un commentaire')]
    #[Assert\Length(max: 1000, maxMessage: 'Le contenu ne peut pas dépasser {{ limit }} caractères')]
    private ?string $content = null;

    #[ORM\Column(type: "datetime_immutable")]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'comments')]
    private ?Trick $trick = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): static
    {
        $this->trick = $trick;

        return $this;
    }

}
