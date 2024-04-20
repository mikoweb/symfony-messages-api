<?php

namespace App\Shared\Application\Interaction\SharedQuery;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

readonly class FindSpecifiedPersonsSharedQuery implements SharedQueryInterface
{
    public function __construct(
        /**
         * @var string[]
         */
        public array $personIds,
    ) {
    }
}
