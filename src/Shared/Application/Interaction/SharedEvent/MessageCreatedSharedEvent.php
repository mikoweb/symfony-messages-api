<?php

namespace App\Shared\Application\Interaction\SharedEvent;

use App\Core\Infrastructure\Interaction\SharedEvent\SharedEventInterface;

readonly class MessageCreatedSharedEvent implements SharedEventInterface
{
    public function __construct(
        public string $messageId,
    ) {
    }
}
