<?php

namespace App\Module\Person\Domain\Document;

use App\Core\Infrastructure\Doctrine\Entity\Interfaces\TimestampableInterface;
use App\Core\Infrastructure\Doctrine\Entity\Traits\TimestampableTrait;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Uid\Uuid;

#[MongoDB\Document(repositoryClass: PersonRepository::class)]
class Person implements TimestampableInterface
{
    use TimestampableTrait;

    #[MongoDB\Id(type: 'string', strategy: 'NONE')]
    private string $id;

    #[MongoDB\Field(name: 'first_name', type: 'string')]
    private string $firstName;

    #[MongoDB\Field(name: 'last_name', type: 'string')]
    private string $lastName;

    #[MongoDB\Field(name: 'album_number', type: 'string')]
    #[MongoDB\UniqueIndex(partialFilterExpression: ['album_number' => ['$type' => 'string']])]
    private ?string $albumNumber = null;

    #[MongoDB\Field(name: 'position', type: 'string')]
    private ?string $position = null;

    public function __construct(
        string $firstName,
        string $lastName,
    ) {
        $this->id = (string) Uuid::v4();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAlbumNumber(): ?string
    {
        return $this->albumNumber;
    }

    public function setAlbumNumber(?string $albumNumber): self
    {
        $this->albumNumber = $albumNumber;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }
}
