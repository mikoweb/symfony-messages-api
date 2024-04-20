<?php

namespace App\Module\Person\UI\Controller\Person;

use App\Core\UI\Api\Controller\AbstractRestController;
use App\Module\Person\Domain\Document\Person;
use App\Shared\UI\Dto\Person\Converter\PersonToDtoConverter;
use App\Shared\UI\Dto\Person\PersonDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class GetPersonController extends AbstractRestController
{
    #[OA\Tag(name: 'Person')]
    #[OA\Response(
        response: 200,
        description: 'Get person.',
        content: new OA\JsonContent(
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: PersonDto::class))]
        )
    )]
    public function getPerson(Person $person, PersonToDtoConverter $converter): Response
    {
        return $this->json($converter->convertToDto($person));
    }
}
