<?php

namespace App\Module\Message\Infrastructure\Persistence\Message;

use App\Module\Message\Domain\Document\Message;
use App\Module\Message\Infrastructure\Persistence\Message\Converter\MessageCreateDtoToDocumentConverter;
use App\Module\Message\Infrastructure\Persistence\Message\Converter\MessageUpdateDtoToDocumentConverter;
use App\Module\Message\Infrastructure\Repository\MessageRepository;
use App\Module\Message\UI\Dto\MessageCreateDto;
use App\Module\Message\UI\Dto\MessageUpdateDto;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use UnexpectedValueException;

readonly class MessagePersistence
{
    public function __construct(
        private DocumentManager $documentManager,
        private MessageCreateDtoToDocumentConverter $createDtoToDocumentConverter,
        private MessageUpdateDtoToDocumentConverter $updateDtoToDocumentConverter,
        private MessageRepository $repository,
    ) {
    }

    public function create(MessageCreateDto $dto): Message
    {
        $message = $this->createDtoToDocumentConverter->convertToDocument($dto);
        $this->documentManager->persist($message);

        return $message;
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function update(string $messageId, MessageUpdateDto $dto): Message
    {
        $message = $this->updateDtoToDocumentConverter->convertToDocument($messageId, $dto);
        $this->documentManager->persist($message);

        return $message;
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function remove(string $messageId): void
    {
        $message = $this->repository->find($messageId);

        if (is_null($message)) {
            throw new UnexpectedValueException(sprintf('Message with id "%s" does not exist.', $messageId));
        }

        $this->documentManager->remove($message);
    }
}
