<?php

namespace App\Module\Person\UI\Dto;

use DateTime;

readonly class PersonDto
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public ?string $albumNumber,
        public ?string $position,
        public ?DateTime $createdAt,
        public ?DateTime $updatedAt,
    ) {
    }
}
