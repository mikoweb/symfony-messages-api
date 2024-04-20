<?php

namespace App\Module\Person\Application\Interaction\Query\FindSpecifiedPersons\Handler;

use App\Module\Person\Application\Interaction\Query\FindSpecifiedPersons\FindSpecifiedPersonsQuery;
use App\Module\Person\Domain\Document\Person;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\Converter\PersonToDtoConverter;
use App\Shared\UI\Dto\Person\PersonDto;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class FindSpecifiedPersonsHandler
{
    public function __construct(
        private PersonRepository $repository,
        private PersonToDtoConverter $converter,
    ) {
    }

    /**
     * @return PersonDto[]
     *
     * @throws MongoDBException
     */
    #[AsMessageHandler(bus: 'query_bus')]
    public function __invoke(FindSpecifiedPersonsQuery $query): array
    {
        $persons = $this->repository->findSpecified($query->personIds);

        return array_map(fn (Person $person) => $this->converter->convertToDto($person), $persons->toArray());
    }
}
