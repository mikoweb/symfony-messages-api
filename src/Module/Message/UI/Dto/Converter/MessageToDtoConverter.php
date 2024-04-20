<?php

namespace App\Module\Message\UI\Dto\Converter;

use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\MessageDto;
use DateTimeImmutable;

readonly class MessageToDtoConverter
{
    public function convertToDto(Message $message): MessageDto
    {
        return new MessageDto(
            id: $message->getId(),
            senderId: $message->getSenderId(),
            recipientId: $message->getRecipientId(),
            subject: $message->getSubject(),
            content: $message->getContent(),
            createdAt: DateTimeImmutable::createFromMutable($message->getCreatedAt()),
            updatedAt: DateTimeImmutable::createFromMutable($message->getUpdatedAt()),
        );
    }
}
