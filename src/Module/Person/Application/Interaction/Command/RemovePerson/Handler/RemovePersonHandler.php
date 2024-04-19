<?php

namespace App\Module\Person\Application\Interaction\Command\RemovePerson\Handler;

use App\Module\Person\Application\Interaction\Command\RemovePerson\RemovePersonCommand;
use App\Module\Person\Infrastructure\Persistence\Person\PersonPersistence;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class RemovePersonHandler
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
    public function handle(RemovePersonCommand $command): void
    {
        $this->persistence->remove($command->personId);
    }
}
