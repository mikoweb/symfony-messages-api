<?php

namespace App\Module\Message\UI\Controller;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\ApiDoc\PaginationApiModel;
use App\Module\Message\Application\Interaction\Query\AskForMessagePaginatedList\AskForMessagePaginatedListQuery;
use App\Module\Message\UI\Dto\MessageDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaginatedListController extends AbstractRestController
{
    #[OA\Tag(name: 'Message')]
    #[OA\Parameter(name: 'page', in: 'query')]
    #[OA\Parameter(name: 'limit', in: 'query')]
    #[OA\Response(
        response: 200,
        description: 'Paginated list of messages.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'items', type: 'array', items: new OA\Items(
                    ref: new Model(type: MessageDto::class)
                )),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: PaginationApiModel::class))]
        )
    )]
    public function getPaginatedList(Request $request, QueryBusInterface $queryBus): Response
    {
        return $this->json($queryBus->dispatch(new AskForMessagePaginatedListQuery(
            PaginationRequest::createFromRequest($request),
        )));
    }
}
