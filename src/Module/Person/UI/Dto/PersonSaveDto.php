<?php

namespace App\Module\Person\UI\Dto;

use App\Module\Person\Application\Validator\PersonAlbumNumberUniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;

#[PersonAlbumNumberUniqueConstraint(groups: ['create', 'check_unique'])]
class PersonSaveDto
{
    #[Assert\Type('null', groups: ['create'])]
    private ?string $personId;

    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        public readonly string $firstName,

        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        public readonly string $lastName,

        #[Assert\Length(min: 4, max: 50)]
        public readonly ?string $albumNumber,

        #[Assert\Length(min: 1, max: 255)]
        public readonly ?string $position,
    ) {
        $this->personId = null;
    }

    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    public function setPersonId(?string $personId): void
    {
        $this->personId = $personId;
    }
}
