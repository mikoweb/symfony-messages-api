<?php

namespace App\Module\Person\Application\Filter\PersonFilter;

use App\Shared\UI\Dto\Person\PersonFilterDto;
use Doctrine\ODM\MongoDB\Query\Builder;

interface FilterInterface
{
    public function supports(PersonFilterDto $filter): bool;
    public function apply(Builder $queryBuilder, PersonFilterDto $filter): void;
}
