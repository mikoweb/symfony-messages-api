<?php

namespace App\Module\Message\Application\Interaction\Command\RemoveMessage\Handler;

use App\Module\Message\Application\Interaction\Command\RemoveMessage\RemoveMessageCommand;
use App\Module\Message\Infrastructure\Persistence\Message\MessagePersistence;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class RemoveMessageHandler
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
    public function handle(RemoveMessageCommand $command): void
    {
        $this->persistence->remove($command->messageId);
    }
}
