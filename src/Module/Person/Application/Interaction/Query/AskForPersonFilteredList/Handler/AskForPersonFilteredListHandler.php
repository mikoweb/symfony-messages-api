<?php

namespace App\Module\Person\Application\Interaction\Query\AskForPersonFilteredList\Handler;

use App\Module\Person\Application\Filter\PersonFilter\PersonFilterBuilder;
use App\Module\Person\Application\Interaction\Query\AskForPersonFilteredList\AskForPersonFilteredListQuery;
use App\Module\Person\Domain\Document\Person;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\Converter\PersonToDtoConverter;
use App\Shared\UI\Dto\Person\PersonDto;
use Doctrine\ODM\MongoDB\Iterator\Iterator;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use UnexpectedValueException;

readonly class AskForPersonFilteredListHandler
{
    public function __construct(
        private PersonRepository $repository,
        private PersonToDtoConverter $converter,
        private PersonFilterBuilder $personFilterBuilder,
    ) {
    }

    /**
     * @return PersonDto[]
     *
     * @throws MongoDBException
     */
    #[AsMessageHandler(bus: 'query_bus')]
    public function handle(AskForPersonFilteredListQuery $query): array
    {
        $qb = $this->repository->createQueryBuilder();
        $applied = $this->personFilterBuilder->build($qb, $query->filter);

        if (!$applied) {
            throw new UnexpectedValueException('No applied filter!');
        }

        /** @var Iterator<Person> $persons */
        $persons = $qb->getQuery()->execute();

        return array_map(fn (Person $person) => $this->converter->convertToDto($person), $persons->toArray());
    }
}
