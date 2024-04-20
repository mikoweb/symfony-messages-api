<?php

namespace App\Module\Message\Domain\Document;

use App\Core\Infrastructure\Doctrine\Entity\Interfaces\TimestampableInterface;
use App\Core\Infrastructure\Doctrine\Entity\Traits\TimestampableTrait;
use App\Module\Message\Infrastructure\Repository\MessageRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Uid\Uuid;

#[MongoDB\Document(repositoryClass: MessageRepository::class)]
class Message implements TimestampableInterface
{
    use TimestampableTrait;

    #[MongoDB\Id(type: 'string', strategy: 'NONE')]
    private string $id;

    #[MongoDB\Field(name: 'sender_id', type: 'string')]
    private string $senderId;

    #[MongoDB\Field(name: 'recipient_id', type: 'string')]
    private string $recipientId;

    #[MongoDB\Field(name: 'subject', type: 'string')]
    private ?string $subject;

    #[MongoDB\Field(name: 'content', type: 'string')]
    private string $content;

    public function __construct(
        string $senderId,
        string $recipientId,
        ?string $subject,
        string $content
    ) {
        $this->id = (string) Uuid::v4();
        $this->senderId = $senderId;
        $this->recipientId = $recipientId;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSenderId(): string
    {
        return $this->senderId;
    }

    public function setSenderId(string $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getRecipientId(): string
    {
        return $this->recipientId;
    }

    public function setRecipientId(string $recipientId): self
    {
        $this->recipientId = $recipientId;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
