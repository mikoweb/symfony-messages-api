<?php

namespace App\Module\Person\Application\Interaction\Command\UpdatePerson\Handler;

use App\Module\Person\Application\Interaction\Command\UpdatePerson\UpdatePersonCommand;
use App\Module\Person\Infrastructure\Persistence\Person\PersonPersistence;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class UpdatePersonHandler
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
    public function handle(UpdatePersonCommand $command): string
    {
        return $this->persistence->save($command->person)->getId();
    }
}
