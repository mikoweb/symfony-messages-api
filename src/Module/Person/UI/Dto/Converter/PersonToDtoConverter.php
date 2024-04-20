<?php

namespace App\Module\Person\UI\Dto\Converter;

use App\Module\Person\Domain\Document\Person;
use App\Shared\UI\Dto\Person\PersonDto;
use DateTimeImmutable;

class PersonToDtoConverter
{
    public function convertToDto(Person $person): PersonDto
    {
        return new PersonDto(
            id: $person->getId(),
            firstName: $person->getFirstName(),
            lastName: $person->getLastName(),
            albumNumber: $person->getAlbumNumber(),
            position: $person->getPosition(),
            createdAt: DateTimeImmutable::createFromMutable($person->getCreatedAt()),
            updatedAt: DateTimeImmutable::createFromMutable($person->getUpdatedAt()),
        );
    }
}
