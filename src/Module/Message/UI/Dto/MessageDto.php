<?php

namespace App\Module\Message\UI\Dto;

use DateTimeImmutable;

readonly class MessageDto
{
    public function __construct(
        public string $id,
        public string $senderId,
        public string $recipientId,
        public ?string $subject,
        public string $content,
        public ?DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
    ) {
    }
}
