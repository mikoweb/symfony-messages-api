<?php

namespace App\Module\Message\Infrastructure\Persistence\Message\Converter;

use App\Module\Message\Domain\Document\Message;
use App\Module\Message\Infrastructure\Repository\MessageRepository;
use App\Module\Message\UI\Dto\MessageUpdateDto;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use UnexpectedValueException;

readonly class MessageUpdateDtoToDocumentConverter
{
    public function __construct(
        private MessageRepository $repository,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function convertToDocument(string $messageId, MessageUpdateDto $dto): Message
    {
        $message = $this->repository->find($messageId);

        if (is_null($message)) {
            throw new UnexpectedValueException(sprintf('Message with id "%s" does not exist.', $messageId));
        }

        $message
            ->setSubject($dto->subject)
            ->setContent($dto->content)
        ;

        return $message;
    }
}
