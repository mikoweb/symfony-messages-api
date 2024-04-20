<?php

namespace App\Module\Person\Application\Interaction\Query\AskForPersonFilteredList;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class AskForPersonFilteredListQuery implements QueryInterface
{
    public function __construct(
        public PersonFilterDto $filter,
    ) {
    }
}
