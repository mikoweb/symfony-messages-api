<?php

namespace App\Module\Person\UI\Dto;

use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class PersonQueryDto
{
    public function __construct(
        public ?PersonFilterDto $filter = null,
    ) {
    }
}
