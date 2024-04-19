<?php

namespace App\Module\Person\UI\Controller\Person;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Person\Application\Interaction\Command\RemovePerson\RemovePersonCommand;
use App\Module\Person\Domain\Document\Person;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class RemoveController extends AbstractRestController
{
    #[OA\Tag(name: 'Person')]
    #[OA\Response(
        response: 200,
        description: 'Remove Person.',
        content: new OA\JsonContent(
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function remove(Person $person, CommandBusInterface $commandBus): Response
    {
        $commandBus->dispatch(new RemovePersonCommand($person->getId()));

        return $this->createSuccessView('The person has been removed!');
    }
}
