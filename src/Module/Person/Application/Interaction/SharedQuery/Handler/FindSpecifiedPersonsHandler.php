<?php

namespace App\Module\Person\Application\Interaction\SharedQuery\Handler;

use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Module\Person\Application\Interaction\Query\FindSpecifiedPersons\FindSpecifiedPersonsQuery;
use App\Shared\Application\Interaction\SharedQuery\FindSpecifiedPersonsSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class FindSpecifiedPersonsHandler
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    /**
     * @return PersonDto[]
     */
    #[AsMessageHandler(bus: 'shared_query_bus')]
    public function handle(FindSpecifiedPersonsSharedQuery $query): array
    {
        return $this->queryBus->dispatch(new FindSpecifiedPersonsQuery($query->personIds));
    }
}
