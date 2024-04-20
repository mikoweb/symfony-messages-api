<?php

namespace App\Module\Message\UI\Dto;

use App\Shared\UI\Dto\Person\PersonDto;
use DateTimeImmutable;

readonly class MessageDto
{
    public function __construct(
        public string $id,
        public PersonDto $sender,
        public PersonDto $recipient,
        public ?string $subject,
        public string $content,
        public ?DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
    ) {
    }
}
