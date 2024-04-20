<?php

namespace App\Module\Message\UI\Controller;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\IdDto;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Message\Application\Interaction\Command\CreateMessage\CreateMessageCommand;
use App\Module\Message\UI\Dto\MessageCreateDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateController extends AbstractRestController
{
    #[OA\Tag(name: 'Message')]
    #[OA\Post(requestBody: new OA\RequestBody(attachables: [new Model(type: MessageCreateDto::class)]))]
    #[OA\Response(
        response: 200,
        description: 'Create Message.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'responseData', ref: new Model(type: IdDto::class)),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function create(
        #[MapRequestPayload] MessageCreateDto $dto,
        CommandBusInterface $commandBus,
    ): Response {
        $id = $commandBus->dispatch(new CreateMessageCommand($dto));

        return $this->createSuccessView('The message has been created!', new IdDto($id));
    }
}
