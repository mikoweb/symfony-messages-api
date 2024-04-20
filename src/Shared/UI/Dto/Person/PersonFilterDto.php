<?php

namespace App\Shared\UI\Dto\Person;

readonly class PersonFilterDto
{
    public function __construct(
        public ?string $id = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $albumNumber = null,
        public ?string $position = null,
    ) {
    }
}
