<?php

namespace App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class AskForMessagePaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
    ) {
    }
}
