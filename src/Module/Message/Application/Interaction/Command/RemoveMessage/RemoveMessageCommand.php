<?php

namespace App\Module\Message\Application\Interaction\Command\RemoveMessage;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;

readonly class RemoveMessageCommand implements CommandInterface
{
    public function __construct(
        public string $messageId,
    ) {
    }
}
