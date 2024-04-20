<?php

namespace App\Module\Person\Application\Filter\PersonFilter;

use App\Module\Person\Application\Filter\PersonFilter\Filter\AlbumNumberFilter;
use App\Module\Person\Application\Filter\PersonFilter\Filter\FirstNameFilter;
use App\Module\Person\Application\Filter\PersonFilter\Filter\IdFilter;
use App\Module\Person\Application\Filter\PersonFilter\Filter\LastNameFilter;
use App\Module\Person\Application\Filter\PersonFilter\Filter\PositionFilter;
use App\Shared\UI\Dto\Person\PersonFilterDto;
use Doctrine\ODM\MongoDB\Query\Builder;

readonly class PersonFilterBuilder
{
    /**
     * @var FilterInterface[]
     */
    private array $filters;

    public function __construct(
        IdFilter $idFilter,
        FirstNameFilter $firstNameFilter,
        LastNameFilter $lastNameFilter,
        AlbumNumberFilter $albumNumberFilter,
        PositionFilter $positionFilter
    ) {
        $this->filters = func_get_args();
    }

    public function build(Builder $queryBuilder, PersonFilterDto $filterDto): bool
    {
        $applied = false;

        foreach ($this->filters as $filter) {
            if ($filter->supports($filterDto)) {
                $filter->apply($queryBuilder, $filterDto);
                $applied = true;
            }
        }

        return $applied;
    }
}
