<?php

namespace App\Module\Message\UI\Dto;

readonly class MessageDto
{
    public function __construct(
        public string $id,
        public string $senderId,
        public string $recipientId,
        public ?string $subject,
        public string $content,
    ) {
    }
}
