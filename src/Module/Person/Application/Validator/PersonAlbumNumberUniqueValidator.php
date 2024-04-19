<?php

namespace App\Module\Person\Application\Validator;

use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Module\Person\Application\Interaction\Query\IsPersonAlbumNumberUnique\IsPersonAlbumNumberUniqueQuery;
use App\Module\Person\UI\Dto\PersonSaveDto;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PersonAlbumNumberUniqueValidator extends ConstraintValidator
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    /**
     * @param PersonSaveDto $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PersonAlbumNumberUniqueConstraint) {
            throw new UnexpectedTypeException($constraint, PersonAlbumNumberUniqueConstraint::class);
        }

        if (!is_object($value)) {
            throw new UnexpectedValueException($value, 'object');
        }

        if (!property_exists($value, 'albumNumber') || !method_exists($value, 'getPersonId')) {
            throw new UnexpectedValueException($value, 'Person DTO');
        }

        if (!is_null($value->albumNumber)) {
            $unique = $this->queryBus->dispatch(new IsPersonAlbumNumberUniqueQuery(
                albumNumber: $value->albumNumber,
                personId: $value->getPersonId(),
            ));

            if (!$unique) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}
