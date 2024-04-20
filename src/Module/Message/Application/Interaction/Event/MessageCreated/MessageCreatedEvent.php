<?php

namespace App\Module\Message\Application\Interaction\Event\MessageCreated;

use App\Core\Infrastructure\Interaction\Event\EventInterface;

readonly class MessageCreatedEvent implements EventInterface
{
    public function __construct(
        public string $messageId,
    ) {
    }
}
