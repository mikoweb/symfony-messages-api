<?php

namespace App\Module\Person\Application\Interaction\Command\RemovePerson;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;

readonly class RemovePersonCommand implements CommandInterface
{
    public function __construct(
        public string $personId,
    ) {
    }
}
