<?php

namespace App\Authentication\Infrastructure\Entity;

use App\Authentication\Infrastructure\Repository\ClientRepository;
use App\Common\Infrastructure\Security\Model\ClientInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client implements ClientInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $redirect_uri = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $allowedGrantTypes = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $scopes = null;

    #[ORM\Column(length: 255)]
    private ?string $secret = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirect_uri;
    }

    public function setRedirectUri(?string $redirect_uri): static
    {
        $this->redirect_uri = $redirect_uri;

        return $this;
    }

    public function getAllowedGrantTypes(): ?array
    {
        return $this->allowedGrantTypes;
    }

    public function setAllowedGrantTypes(?array $allowedGrantTypes): static
    {
        $this->allowedGrantTypes = $allowedGrantTypes;

        return $this;
    }

    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    public function setScopes(?array $scopes): static
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): static
    {
        $this->secret = $secret;

        return $this;
    }

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function isConfidential()
    {
        // TODO: Implement isConfidential() method.
    }
}
