<?php

namespace App\Shared\UI\Dto\Message\Converter;

use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Message\Domain\Document\Message;
use App\Shared\Application\Interaction\SharedQuery\FindPersonSharedQuery;
use App\Shared\UI\Dto\Message\MessageDto;
use DateTimeImmutable;

readonly class MessageToDtoConverter
{
    public function __construct(
        private SharedQueryBusInterface $sharedQueryBus,
    ) {
    }

    public function convertToDto(Message $message): MessageDto
    {
        return new MessageDto(
            id: $message->getId(),
            sender: $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getSenderId())),
            recipient: $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getRecipientId())),
            subject: $message->getSubject(),
            content: $message->getContent(),
            createdAt: DateTimeImmutable::createFromMutable($message->getCreatedAt()),
            updatedAt: DateTimeImmutable::createFromMutable($message->getUpdatedAt()),
        );
    }
}
