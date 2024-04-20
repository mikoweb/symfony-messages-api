<?php

namespace App\Module\Message\Application\Filter\MessageFilter\Filter;

use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Module\Message\Application\Filter\MessageFilter\FilterInterface;
use App\Module\Message\Application\Interaction\Query\FindPersonCollection\FindPersonCollectionQuery;
use App\Module\Message\UI\Dto\MessageQueryDto;
use App\Shared\UI\Dto\Person\PersonDto;
use Doctrine\ODM\MongoDB\Query\Builder;
use Ramsey\Collection\Collection;

readonly class RecipientFilter implements FilterInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function supports(MessageQueryDto $query): bool
    {
        return !is_null($query->recipient);
    }

    public function apply(Builder $queryBuilder, MessageQueryDto $query): void
    {
        /** @var Collection<PersonDto> $recipients */
        $recipients = $this->queryBus->dispatch(new FindPersonCollectionQuery($query->recipient));
        $queryBuilder->field('recipientId')->in(array_unique($recipients->column('id')));
    }
}
