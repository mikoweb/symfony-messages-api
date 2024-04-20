<?php

namespace App\Module\Message\Application\Interaction\Query\FindPersonCollection;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class FindPersonCollectionQuery implements QueryInterface
{
    public function __construct(
        public PersonFilterDto $filter
    ) {
    }
}
