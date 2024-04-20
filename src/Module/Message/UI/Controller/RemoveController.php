<?php

namespace App\Module\Message\UI\Controller;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Message\Application\Interaction\Command\RemoveMessage\RemoveMessageCommand;
use App\Module\Message\Domain\Document\Message;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class RemoveController extends AbstractRestController
{
    #[OA\Tag(name: 'Message')]
    #[OA\Response(
        response: 200,
        description: 'Remove Message.',
        content: new OA\JsonContent(
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function remove(Message $message, CommandBusInterface $commandBus): Response
    {
        $commandBus->dispatch(new RemoveMessageCommand($message->getId()));

        return $this->createSuccessView('The message has been removed!');
    }
}
