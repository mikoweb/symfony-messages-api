<?php

namespace App\Module\Person\Application\Interaction\Query\FindSpecifiedPersons;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class FindSpecifiedPersonsQuery implements QueryInterface
{
    public function __construct(
        /**
         * @var string[]
         */
        public array $personIds,
    ) {
    }
}
