<?php

namespace App\Module\Message\Application\Interaction\Query\FindPersonCollection\Handler;

use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Message\Application\Interaction\Query\FindPersonCollection\FindPersonCollectionQuery;
use App\Shared\Application\Interaction\SharedQuery\AskForPersonFilteredListSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Ramsey\Collection\Collection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use UnexpectedValueException;

readonly class FindPersonCollectionHandler
{
    public function __construct(
        private SharedQueryBusInterface $sharedQueryBus,
    ) {
    }

    /**
     * @return Collection<PersonDto>
     */
    #[AsMessageHandler('query_bus')]
    public function handle(FindPersonCollectionQuery $query): Collection
    {
        try {
            $senders = $this->sharedQueryBus->dispatch(new AskForPersonFilteredListSharedQuery($query->filter));
        } catch (HandlerFailedException $exception) {
            if ($exception->getPrevious()?->getPrevious() instanceof UnexpectedValueException) {
                $senders = [];
            } else {
                throw $exception;
            }
        }

        return new Collection(PersonDto::class, $senders);
    }
}
