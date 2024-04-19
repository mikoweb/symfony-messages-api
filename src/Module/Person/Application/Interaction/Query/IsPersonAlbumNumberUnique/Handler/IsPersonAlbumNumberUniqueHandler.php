<?php

namespace App\Module\Person\Application\Interaction\Query\IsPersonAlbumNumberUnique\Handler;

use App\Module\Person\Application\Interaction\Query\IsPersonAlbumNumberUnique\IsPersonAlbumNumberUniqueQuery;
use App\Module\Person\Infrastructure\Repository\PersonRepository;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class IsPersonAlbumNumberUniqueHandler
{
    public function __construct(
        private PersonRepository $personRepository,
    ) {
    }

    /**
     * @throws MongoDBException
     */
    #[AsMessageHandler(bus: 'query_bus')]
    public function handle(IsPersonAlbumNumberUniqueQuery $query): bool
    {
        $qb = $this->personRepository->createQueryBuilder()
            ->count()
            ->field('albumNumber')
            ->equals($query->albumNumber)
        ;

        if (!is_null($query->personId)) {
            $qb
                ->field('id')
                ->notEqual($query->personId)
            ;
        }

        return $qb->getQuery()->execute() === 0;
    }
}
