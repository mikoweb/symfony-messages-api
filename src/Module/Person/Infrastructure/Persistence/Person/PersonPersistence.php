<?php

namespace App\Module\Person\Infrastructure\Persistence\Person;

use App\Module\Person\Domain\Document\Person;
use App\Module\Person\Infrastructure\Persistence\Person\Converter\PersonSaveDtoToDocumentConverter;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use App\Module\Person\UI\Dto\PersonSaveDto;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use UnexpectedValueException;

readonly class PersonPersistence
{
    public function __construct(
        private DocumentManager $documentManager,
        private PersonSaveDtoToDocumentConverter $converter,
        private PersonRepository $personRepository,
    ) {
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function save(PersonSaveDto $dto): Person
    {
        $person = $this->converter->convertToDocument($dto);
        $this->documentManager->persist($person);

        return $person;
    }

    /**
     * @throws MappingException
     * @throws LockException
     */
    public function remove(string $id): void
    {
        $person = $this->personRepository->find($id);

        if (is_null($person)) {
            throw new UnexpectedValueException(sprintf('Person with ID %s not found!', $id));
        }

        $this->documentManager->remove($person);
    }
}
