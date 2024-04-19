<?php

namespace App\Module\Person\Application\Validator;

use Symfony\Component\Validator\Constraint;
use Attribute;

#[Attribute]
class PersonAlbumNumberUniqueConstraint extends Constraint
{
    public string $message = 'Person Album Number is not unique!';

    public function validatedBy(): string
    {
        return PersonAlbumNumberUniqueValidator::class;
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
