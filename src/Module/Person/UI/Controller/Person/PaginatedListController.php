<?php

namespace App\Module\Person\UI\Controller\Person;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\ApiDoc\PaginationApiModel;
use App\Module\Person\Application\Interaction\Query\AskForPersonPaginatedList\AskForPersonPaginatedListQuery;
use App\Shared\UI\Dto\Person\PersonDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaginatedListController extends AbstractRestController
{
    #[OA\Tag(name: 'Person')]
    #[OA\Parameter(name: 'page', in: 'query')]
    #[OA\Parameter(name: 'limit', in: 'query')]
    #[OA\Response(
        response: 200,
        description: 'Paginated list of persons.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'items', type: 'array', items: new OA\Items(
                    ref: new Model(type: PersonDto::class)
                )),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: PaginationApiModel::class))]
        )
    )]
    public function getPaginatedList(Request $request, QueryBusInterface $queryBus): Response
    {
        return $this->json($queryBus->dispatch(new AskForPersonPaginatedListQuery(
            PaginationRequest::createFromRequest($request),
        )));
    }
}
