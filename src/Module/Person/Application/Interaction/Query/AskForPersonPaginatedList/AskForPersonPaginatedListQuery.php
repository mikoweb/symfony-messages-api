<?php

namespace App\Module\Person\Application\Interaction\Query\AskForPersonPaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class AskForPersonPaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
        public ?PersonFilterDto $filter = null,
    ) {
    }
}
