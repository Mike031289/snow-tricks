<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
#[ORM\Table(name: 'trick')]
#[UniqueEntity(fields: 'name', message: 'Cette figure a déjà été enregistrée')]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]
    private ?string $name = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'La description ne peut pas être vide')]
    private ?string $description = null;

    // #[ORM\Column(name: 'user_id')]
    // private ?int $userId = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'tricks')]
    private ?Category $category = null;

    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'trick')]
    private Collection $comments;

    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'trick', cascade: ['persist', 'remove'])]
    private Collection $pictures;

    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'trick', orphanRemoval: true)]
    private Collection $videos;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->videos   = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    // public function getUserId(): ?int
    // {
    //     return $this->userId;
    // }

    // public function setUserId(int $userId): self
    // {
    //     $this->userId = $userId;

    //     return $this;
    // }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    // /**
    //  * @return Collection|Media[]
    //  */
    // public function getMedias(): Collection
    // {
    //     return $this->medias;
    // }

    // public function addMedia(Media $media): self
    // {
    //     if (!$this->medias->contains($media)) {
    //         $this->medias[] = $media;
    //         $media->setTrick($this);
    //     }

    //     return $this;
    // }

    // public function removeMedia(Media $media): self
    // {
    //     if ($this->medias->removeElement($media)) {
    //         // set the owning side to null (unless already changed)
    //         if ($media->getTrick() === $this) {
    //             $media->setTrick(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setTrick($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getTrick() === $this) {
                $picture->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setTrick($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getTrick() === $this) {
                $video->setTrick(null);
            }
        }

        return $this;
    }
}
