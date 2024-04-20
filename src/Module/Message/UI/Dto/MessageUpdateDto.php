<?php

namespace App\Module\Message\UI\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class MessageUpdateDto
{
    public function __construct(
        #[Assert\Length(min: 0, max: 255)]
        public ?string $subject,

        #[Assert\NotBlank]
        public string $content,
    ) {
    }
}
