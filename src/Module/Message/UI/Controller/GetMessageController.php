<?php

namespace App\Module\Message\UI\Controller;

use App\Core\UI\Api\Controller\AbstractRestController;
use App\Module\Message\Domain\Document\Message;
use App\Module\Message\UI\Dto\Converter\MessageToDtoConverter;
use App\Module\Message\UI\Dto\MessageDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class GetMessageController extends AbstractRestController
{
    #[OA\Tag(name: 'Message')]
    #[OA\Response(
        response: 200,
        description: 'Get Message.',
        content: new OA\JsonContent(
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: MessageDto::class))]
        )
    )]
    public function getMessage(Message $message, MessageToDtoConverter $converter): Response
    {
        return $this->json($converter->convertToDto($message));
    }
}
