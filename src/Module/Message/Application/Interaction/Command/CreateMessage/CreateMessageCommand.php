<?php

namespace App\Module\Message\Application\Interaction\Command\CreateMessage;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use App\Module\Message\UI\Dto\MessageCreateDto;

readonly class CreateMessageCommand implements CommandInterface
{
    public function __construct(
        public MessageCreateDto $message,
    ) {
    }
}
