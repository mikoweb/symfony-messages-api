<?php

namespace App\Shared\Application\Validator;

use App\Module\Person\Infrastructure\Repository\PersonRepository;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PersonExistsValidator extends ConstraintValidator
{
    public function __construct(
        private readonly PersonRepository $repository,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PersonExistsConstraint) {
            throw new UnexpectedTypeException($constraint, PersonExistsConstraint::class);
        }

        if (!is_string($value) && !is_null($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!is_null($value)) {
            $person = $this->repository->find($value);

            if (is_null($person)) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}
