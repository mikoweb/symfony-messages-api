<?php

namespace App\Module\Person\Infrastructure\Repository;

use App\Module\Person\Domain\Document\Person;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\ODM\MongoDB\Iterator\Iterator;
use Doctrine\ODM\MongoDB\MongoDBException;

/**
 * @extends ServiceDocumentRepository<Person>
 *
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param string[] $personIds
     *
     * @return Iterator<Person>
     *
     * @throws MongoDBException
     */
    public function findSpecified(array $personIds): Iterator
    {
        return $this->createQueryBuilder()
            ->field('id')
            ->in($personIds)
            ->getQuery()
            ->execute()
        ;
    }
}
