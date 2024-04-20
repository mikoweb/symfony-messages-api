<?php

namespace App\Shared\Application\Interaction\SharedQuery;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

readonly class FindPersonSharedQuery implements SharedQueryInterface
{
    public function __construct(
        public string $id,
    ) {
    }
}
