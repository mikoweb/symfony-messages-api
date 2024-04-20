<?php

namespace App\Module\Message\Infrastructure\Persistence\Message\Converter;

use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\MessageCreateDto;

readonly class MessageCreateDtoToDocumentConverter
{
    public function convertToDocument(MessageCreateDto $dto): Message
    {
        return new Message(
            senderId: $dto->senderId,
            recipientId: $dto->recipientId,
            subject: $dto->subject,
            content: $dto->content,
        );
    }
}
