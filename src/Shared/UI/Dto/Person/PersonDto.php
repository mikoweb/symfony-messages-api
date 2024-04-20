<?php

namespace App\Shared\UI\Dto\Person;

use DateTimeImmutable;

readonly class PersonDto
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public ?string $albumNumber,
        public ?string $position,
        public ?DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
    ) {
    }
}
