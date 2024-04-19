<?php

namespace App\Core\Domain\Pagination;

use Symfony\Component\HttpFoundation\Request;

final readonly class PaginationRequest
{
    public function __construct(
        public int $page = PaginationConst::DEFAULT_PAGE,
        public int $limit = PaginationConst::DEFAULT_LIMIT
    ) {
    }

    public static function createFromRequest(Request $request): self
    {
        return new self(
            $request->query->get('page', PaginationConst::DEFAULT_PAGE),
            $request->query->get('limit', PaginationConst::DEFAULT_LIMIT),
        );
    }
}
