<?php

namespace App\Module\Person\Application\Interaction\SharedQuery\Handler;

use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Module\Person\Application\Interaction\Query\AskForPersonFilteredList\AskForPersonFilteredListQuery;
use App\Shared\Application\Interaction\SharedQuery\AskForPersonFilteredListSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class AskForPersonFilteredListHandler
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    /**
     * @return PersonDto[]
     */
    #[AsMessageHandler(bus: 'shared_query_bus')]
    public function handle(AskForPersonFilteredListSharedQuery $query): array
    {
        return $this->queryBus->dispatch(new AskForPersonFilteredListQuery($query->filter));
    }
}
