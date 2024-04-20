<?php

namespace App\Module\Message\Application\Interaction\Command\UpdateMessage;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use App\Module\Message\UI\Dto\MessageUpdateDto;

readonly class UpdateMessageCommand implements CommandInterface
{
    public function __construct(
        public string $messageId,
        public MessageUpdateDto $message,
    ) {
    }
}
