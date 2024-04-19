<?php

namespace App\Module\Person\Application\Interaction\Query\AskForPersonPaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class AskForPersonPaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
    ) {
    }
}
