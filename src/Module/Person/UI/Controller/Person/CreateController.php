<?php

namespace App\Module\Person\UI\Controller\Person;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\IdDto;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Person\Application\Interaction\Command\CreatePerson\CreatePersonCommand;
use App\Module\Person\UI\Dto\PersonSaveDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateController extends AbstractRestController
{
    #[OA\Tag(name: 'Person')]
    #[OA\Post(requestBody: new OA\RequestBody(attachables: [new Model(type: PersonSaveDto::class)]))]
    #[OA\Response(
        response: 200,
        description: 'Create Person.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'responseData', ref: new Model(type: IdDto::class)),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function create(
        #[MapRequestPayload(validationGroups: ['Default', 'create'])] PersonSaveDto $dto,
        CommandBusInterface $commandBus,
    ): Response {
        $id = $commandBus->dispatch(new CreatePersonCommand($dto));

        return $this->createSuccessView('The person has been created!', new IdDto($id));
    }
}
