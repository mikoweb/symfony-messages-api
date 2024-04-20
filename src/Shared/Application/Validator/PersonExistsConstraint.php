<?php

namespace App\Shared\Application\Validator;

use Symfony\Component\Validator\Constraint;
use Attribute;

#[Attribute]
class PersonExistsConstraint extends Constraint
{
    public string $message = 'Person with the given ID does not exist!';

    public function validatedBy(): string
    {
        return PersonExistsValidator::class;
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
