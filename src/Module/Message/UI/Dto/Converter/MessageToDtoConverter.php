<?php

namespace App\Module\Message\UI\Dto\Converter;

use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\MessageDto;
use App\Shared\Application\Interaction\SharedQuery\FindPersonSharedQuery;
use DateTimeImmutable;

readonly class MessageToDtoConverter
{
    public function __construct(
        private SharedQueryBusInterface $sharedQueryBus,
    ) {
    }

    public function convertToDto(Message $message): MessageDto
    {
        $sender = $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getSenderId()));
        $recipient = $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getRecipientId()));

        return new MessageDto(
            id: $message->getId(),
            sender: $sender,
            recipient: $recipient,
            subject: $message->getSubject(),
            content: $message->getContent(),
            createdAt: DateTimeImmutable::createFromMutable($message->getCreatedAt()),
            updatedAt: DateTimeImmutable::createFromMutable($message->getUpdatedAt()),
        );
    }
}
