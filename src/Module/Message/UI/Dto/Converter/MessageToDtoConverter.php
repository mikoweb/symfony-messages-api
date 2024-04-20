<?php

namespace App\Module\Message\UI\Dto\Converter;

use App\Core\Application\Collection\ByIdTypedMap;
use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\MessageDto;
use App\Shared\Application\Interaction\SharedQuery\FindPersonSharedQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use DateTimeImmutable;

readonly class MessageToDtoConverter
{
    public function __construct(
        private SharedQueryBusInterface $sharedQueryBus,
    ) {
    }

    /**
     * @param ByIdTypedMap<string, PersonDto>|null $personMap
     */
    public function convertToDto(Message $message, ?ByIdTypedMap $personMap = null): MessageDto
    {
        $sender = $personMap?->get($message->getSenderId())
            ?? $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getSenderId()));

        $recipient = $personMap?->get($message->getRecipientId())
            ?? $this->sharedQueryBus->dispatch(new FindPersonSharedQuery($message->getRecipientId()));

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
