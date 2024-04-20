<?php

namespace App\Module\Person\Application\Filter\PersonFilter\Filter;

use App\Module\Person\Application\Filter\PersonFilter\FilterInterface;
use App\Shared\UI\Dto\Person\PersonFilterDto;
use Doctrine\ODM\MongoDB\Query\Builder;

class FirstNameFilter implements FilterInterface
{
    public function supports(PersonFilterDto $filter): bool
    {
        return !is_null($filter->firstName);
    }

    public function apply(Builder $queryBuilder, PersonFilterDto $filter): void
    {
        $queryBuilder->field('firstName')->equals($filter->firstName);
    }
}
