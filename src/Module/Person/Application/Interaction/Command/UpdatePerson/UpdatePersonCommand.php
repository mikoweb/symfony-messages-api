<?php

namespace App\Module\Person\Application\Interaction\Command\UpdatePerson;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use App\Module\Person\UI\Dto\PersonSaveDto;

class UpdatePersonCommand implements CommandInterface
{
    public function __construct(
        public PersonSaveDto $person,
    ) {
    }
}
