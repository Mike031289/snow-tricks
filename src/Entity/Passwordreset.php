<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PasswordresetRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\MappedSuperclass(repositoryClass: PasswordresetRepository::class)]
class PasswordReset
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Renseigner votre adresse mail')]
    #[Assert\Email(message: 'l\'adresse mail "{{ value }}" n\'est pas valide')]
    private ?string $email = null;
    
    #[ORM\Column(type: "string", length: 255)]
    private string $token;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $expiresAt;

    // Getters and setters
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpiresAt(): \DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}