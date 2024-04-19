<?php

namespace App\Module\Person\Application\Interaction\Command\CreatePerson\Handler;

use App\Module\Person\Application\Interaction\Command\CreatePerson\CreatePersonCommand;
use App\Module\Person\Infrastructure\Persistence\Person\PersonPersistence;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class CreatePersonHandler
{
    public function __construct(
        private PersonPersistence $persistence,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    #[AsMessageHandler(bus: 'command_bus')]
    public function handle(CreatePersonCommand $command): string
    {
        return $this->persistence->save($command->person)->getId();
    }
}
