<?php

namespace App\Module\Person\Application\Interaction\Query\AskForPersonPaginatedList\Handler;

use App\Core\Application\Pagination\AbstractPaginatedHandler;
use App\Core\Application\Pagination\PaginationFactory;
use App\Core\Domain\Pagination\Pagination;
use App\Module\Person\Application\Filter\PersonFilter\PersonFilterBuilder;
use App\Module\Person\Application\Interaction\Query\AskForPersonPaginatedList\AskForPersonPaginatedListQuery;
use App\Module\Person\Domain\Document\Person;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\Converter\PersonToDtoConverter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class AskForPersonPaginatedListHandler extends AbstractPaginatedHandler
{
    public function __construct(
        private readonly PersonRepository $repository,
        private readonly PersonToDtoConverter $converter,
        private readonly PersonFilterBuilder $personFilterBuilder,
        PaginatorInterface $paginator,
        PaginationFactory $paginationFactory,
    ) {
        parent::__construct($paginator, $paginationFactory);
    }

    #[AsMessageHandler(bus: 'query_bus')]
    public function handle(AskForPersonPaginatedListQuery $query): Pagination
    {
        $qb = $this->repository->createQueryBuilder();
        $qb->sort('createdAt', 'desc');

        if (!is_null($query->filter)) {
            $this->personFilterBuilder->build($qb, $query->filter);
        }

        return $this->paginate($qb, $query->paginationRequest);
    }

    protected function getItems(array $items): array
    {
        return array_map(fn (Person $person) => $this->converter->convertToDto($person), $items);
    }
}
