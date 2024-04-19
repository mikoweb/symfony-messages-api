<?php

namespace App\Module\Person\Application\Interaction\Query\IsPersonAlbumNumberUnique;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class IsPersonAlbumNumberUniqueQuery implements QueryInterface
{
    public function __construct(
        public string $albumNumber,
        public ?string $personId = null,
    ) {
    }
}
