<?php

namespace App\Module\Person\UI\Dto\Converter;

use App\Module\Person\Domain\Document\Person;
use App\Module\Person\UI\Dto\PersonDto;

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
            createdAt: $person->getCreatedAt(),
            updatedAt: $person->getUpdatedAt(),
        );
    }
}
