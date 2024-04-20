<?php

namespace App\Module\Person\Application\Interaction\SharedQuery\Handler;

use App\Core\Application\Exception\NotFoundException;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\Converter\PersonToDtoConverter;
use App\Shared\Application\Interaction\SharedQuery\FindPersonSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class FindPersonHandler
{
    public function __construct(
        private PersonRepository $repository,
        private PersonToDtoConverter $converter,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     * @throws NotFoundException
     */
    #[AsMessageHandler(bus: 'shared_query_bus')]
    public function handle(FindPersonSharedQuery $query): PersonDto
    {
        $person = $this->repository->find($query->id);

        if (is_null($person)) {
            throw new NotFoundException(sprintf('Person with id %s not found.', $query->id));
        }

        return $this->converter->convertToDto($person);
    }
}
