<?php

namespace App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList\Handler;

use App\Core\Application\Pagination\AbstractPaginatedHandler;
use App\Core\Application\Pagination\PaginationFactory;
use App\Core\Domain\Pagination\Pagination;
use App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList\AskForMessagePaginatedListQuery;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\Infrastructure\Repository\MessageRepository;
use App\Module\Message\UI\Dto\Converter\MessageToDtoConverter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class AskForMessagePaginatedHandler extends AbstractPaginatedHandler
{
    public function __construct(
        private readonly MessageRepository $repository,
        private readonly MessageToDtoConverter $converter,
        PaginatorInterface $paginator,
        PaginationFactory $paginationFactory
    ) {
        parent::__construct($paginator, $paginationFactory);
    }

    #[AsMessageHandler(bus: 'query_bus')]
    public function handle(AskForMessagePaginatedListQuery $query): Pagination
    {
        return $this->paginate($this->repository->createQueryBuilder(), $query->paginationRequest);
    }

    protected function getItems(array $items): array
    {
        return array_map(fn (Message $message) => $this->converter->convertToDto($message), $items);
    }
}
