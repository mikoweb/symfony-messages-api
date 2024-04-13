<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use Symfony\Component\Messenger\Stamp\StampInterface;

interface QueryBusInterface
{
    /**
     * @param StampInterface[] $stamps
     */
    public function dispatch(QueryInterface $query, array $stamps = []): mixed;
}
