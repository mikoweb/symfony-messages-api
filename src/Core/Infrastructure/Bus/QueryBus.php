<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\StampInterface;

readonly class QueryBus implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $queryBus,
    ) {
    }

    /**
     * @param StampInterface[] $stamps
     */
    public function dispatch(QueryInterface $query, array $stamps = []): mixed
    {
        $envelope = $this->queryBus->dispatch($query, $stamps);

        return $envelope->last(HandledStamp::class)?->getResult();
    }
}
