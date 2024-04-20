<?php

namespace App\Module\Message\UI\Dto;

use App\Shared\UI\Dto\Person\PersonFilterDto;

readonly class MessageQueryDto
{
    public function __construct(
        public ?PersonFilterDto $sender = null,
        public ?PersonFilterDto $recipient = null,
        public ?string $subject = null,
    ) {
    }
}
