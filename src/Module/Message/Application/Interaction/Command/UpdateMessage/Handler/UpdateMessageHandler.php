<?php

namespace App\Module\Message\Application\Interaction\Command\UpdateMessage\Handler;

use App\Module\Message\Application\Interaction\Command\UpdateMessage\UpdateMessageCommand;
use App\Module\Message\Infrastructure\Persistence\Message\MessagePersistence;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class UpdateMessageHandler
{
    public function __construct(
        private MessagePersistence $persistence,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    #[AsMessageHandler(bus: 'command_bus')]
    public function handle(UpdateMessageCommand $command): string
    {
        return $this->persistence->update($command->messageId, $command->message)->getId();
    }
}
