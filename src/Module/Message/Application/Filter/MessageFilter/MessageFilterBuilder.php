<?php

namespace App\Module\Message\Application\Filter\MessageFilter;

use App\Module\Message\Application\Filter\MessageFilter\Filter\RecipientFilter;
use App\Module\Message\Application\Filter\MessageFilter\Filter\SenderFilter;
use App\Module\Message\Application\Filter\MessageFilter\Filter\SubjectFilter;
use App\Module\Message\UI\Dto\MessageQueryDto;
use Doctrine\ODM\MongoDB\Query\Builder;

readonly class MessageFilterBuilder
{
    /**
     * @var FilterInterface[]
     */
    private array $filters;

    public function __construct(
        SenderFilter $senderFilter,
        RecipientFilter $recipientFilter,
        SubjectFilter $subjectFilter,
    ) {
        $this->filters = func_get_args();
    }

    public function build(Builder $queryBuilder, MessageQueryDto $query): bool
    {
        $applied = false;

        foreach ($this->filters as $filter) {
            if ($filter->supports($query)) {
                $filter->apply($queryBuilder, $query);
                $applied = true;
            }
        }

        return $applied;
    }
}
