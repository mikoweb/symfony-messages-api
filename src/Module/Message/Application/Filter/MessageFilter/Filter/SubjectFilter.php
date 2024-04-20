<?php

namespace App\Module\Message\Application\Filter\MessageFilter\Filter;

use App\Module\Message\Application\Filter\MessageFilter\FilterInterface;
use App\Module\Message\UI\Dto\MessageQueryDto;
use Doctrine\ODM\MongoDB\Query\Builder;

class SubjectFilter implements FilterInterface
{
    public function supports(MessageQueryDto $query): bool
    {
        return !is_null($query->subject);
    }

    public function apply(Builder $queryBuilder, MessageQueryDto $query): void
    {
        $queryBuilder->field('subject')->equals($query->subject);
    }
}
