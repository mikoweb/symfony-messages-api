<?php

namespace App\Module\Person\Infrastructure\Persistence\Person\Converter;

use App\Module\Person\Domain\Document\Person;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\PersonSaveDto;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use UnexpectedValueException;

readonly class PersonSaveDtoToDocumentConverter
{
    public function __construct(
        private PersonRepository $personRepository,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function convertToDocument(PersonSaveDto $dto): Person
    {
        if (is_null($dto->getPersonId())) {
            $person = new Person(firstName: $dto->firstName, lastName: $dto->lastName);
        } else {
            $person = $this->personRepository->find($dto->getPersonId());

            if (is_null($person)) {
                throw new UnexpectedValueException(sprintf('Person with ID %s not found!', $dto->getPersonId()));
            }

            $person
                ->setFirstName($dto->firstName)
                ->setLastName($dto->lastName)
            ;
        }

        $person
            ->setAlbumNumber($dto->albumNumber)
            ->setPosition($dto->position)
        ;

        return $person;
    }
}
