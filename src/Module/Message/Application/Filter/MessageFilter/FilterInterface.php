<?php

namespace App\Module\Message\Application\Filter\MessageFilter;

use App\Module\Message\UI\Dto\MessageQueryDto;
use Doctrine\ODM\MongoDB\Query\Builder;

interface FilterInterface
{
    public function supports(MessageQueryDto $query): bool;
    public function apply(Builder $queryBuilder, MessageQueryDto $query): void;
}
