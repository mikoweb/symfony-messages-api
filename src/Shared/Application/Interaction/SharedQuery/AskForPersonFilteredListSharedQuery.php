<?php

namespace App\Shared\Application\Interaction\SharedQuery;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;
use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class AskForPersonFilteredListSharedQuery implements SharedQueryInterface
{
    public function __construct(
        public PersonFilterDto $filter,
    ) {
    }
}
