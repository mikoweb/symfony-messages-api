<?php

namespace App\Module\Message\UI\Dto;

use App\Shared\Application\Validator\PersonExistsConstraint;
use Symfony\Component\Validator\Constraints as Assert;

readonly class MessageCreateDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[PersonExistsConstraint]
        public string $senderId,

        #[Assert\NotBlank]
        #[PersonExistsConstraint]
        public string $recipientId,

        #[Assert\Length(min: 0, max: 255)]
        public ?string $subject,

        #[Assert\NotBlank]
        public string $content,
    ) {
    }
}
