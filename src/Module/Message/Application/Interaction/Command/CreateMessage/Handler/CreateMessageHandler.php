<?php

namespace App\Module\Message\Application\Interaction\Command\CreateMessage\Handler;

use App\Module\Message\Application\Interaction\Command\CreateMessage\CreateMessageCommand;
use App\Module\Message\Infrastructure\Persistence\Message\MessagePersistence;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class CreateMessageHandler
{
    public function __construct(
        private MessagePersistence $persistence,
    ) {
    }

    #[AsMessageHandler(bus: 'command_bus')]
    public function handle(CreateMessageCommand $command): string
    {
        return $this->persistence->create($command->message)->getId();
    }
}
