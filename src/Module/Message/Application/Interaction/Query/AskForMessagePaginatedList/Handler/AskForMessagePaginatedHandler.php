<?php

namespace App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList\Handler;

use App\Core\Application\Collection\ByIdTypedMap;
use App\Core\Application\Pagination\PaginationFactory;
use App\Core\Domain\Pagination\Pagination;
use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Message\Application\Filter\MessageFilter\MessageFilterBuilder;
use App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList\AskForMessagePaginatedListQuery;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\Infrastructure\Repository\MessageRepository;
use App\Module\Message\UI\Dto\Converter\MessageToDtoConverter;
use App\Module\Message\UI\Dto\MessageDto;
use App\Shared\Application\Interaction\SharedQuery\FindSpecifiedPersonsSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Iterator\Iterator;
use Doctrine\ODM\MongoDB\Query\Builder;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\PaginatorInterface;
use Ramsey\Collection\Collection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class AskForMessagePaginatedHandler
{
    public function __construct(
        private MessageRepository $repository,
        private MessageToDtoConverter $converter,
        private MessageFilterBuilder $messageFilterBuilder,
        private PaginatorInterface $paginator,
        private PaginationFactory $paginationFactory,
        private SharedQueryBusInterface $sharedQueryBus,
    ) {
    }

    /**
     * @throws MongoDBException
     */
    #[AsMessageHandler(bus: 'query_bus')]
    public function handle(AskForMessagePaginatedListQuery $query): Pagination
    {
        $qb = $this->repository->createQueryBuilder();
        $qb->sort('createdAt', 'desc');
        $this->messageFilterBuilder->build($qb, $query->query);
        $personMap = $this->getPersonMap(clone $qb);
        $request = $query->paginationRequest;

        /** @var SlidingPagination<int, object> $pagination */
        $pagination = $this->paginator->paginate($qb, $request->page, $request->limit);

        return $this->paginationFactory->create($pagination, $this->getItems(
            $pagination->getItems(),
            $personMap,
        ));
    }

    /**
     * @param object[]                        $items
     * @param ByIdTypedMap<string, PersonDto> $personMap
     *
     * @return MessageDto[]
     */
    private function getItems(array $items, ByIdTypedMap $personMap): array
    {
        return array_map(fn (Message $message) => $this->converter->convertToDto($message, $personMap), $items);
    }

    /**
     * @return ByIdTypedMap<string, PersonDto>
     *
     * @throws MongoDBException
     */
    private function getPersonMap(Builder $qb): ByIdTypedMap
    {
        /** @var Iterator<Message> $rawResult */
        $rawResult = $qb->getQuery()->execute();
        $rawCollection = new Collection(Message::class, $rawResult->toArray());

        /** @var string[] $ids */
        $ids = array_unique([
            ...$rawCollection->column('getSenderId'),
            ...$rawCollection->column('getRecipientId'),
        ]);

        $persons = $this->sharedQueryBus->dispatch(new FindSpecifiedPersonsSharedQuery($ids));

        return new ByIdTypedMap('string', PersonDto::class, $persons);
    }
}
