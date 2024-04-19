<?php

namespace App\Module\Person\Application\Interaction\Command\CreatePerson;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use App\Module\Person\UI\Dto\PersonSaveDto;

readonly class CreatePersonCommand implements CommandInterface
{
    public function __construct(
        public PersonSaveDto $person,
    ) {
    }
}
