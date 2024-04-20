<?php

namespace App\Module\Message\UI\Controller;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\IdDto;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Message\Application\Interaction\Command\UpdateMessage\UpdateMessageCommand;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\MessageUpdateDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class UpdateController extends AbstractRestController
{
    #[OA\Tag(name: 'Message')]
    #[OA\Post(requestBody: new OA\RequestBody(attachables: [new Model(type: MessageUpdateDto::class)]))]
    #[OA\Response(
        response: 200,
        description: 'Update Message.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'responseData', ref: new Model(type: IdDto::class)),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function update(
        Message $message,
        #[MapRequestPayload] MessageUpdateDto $dto,
        CommandBusInterface $commandBus,
    ): Response {
        $id = $commandBus->dispatch(new UpdateMessageCommand($message->getId(), $dto));

        return $this->createSuccessView('The message has been updated!', new IdDto($id));
    }
}
