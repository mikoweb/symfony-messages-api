<?php

namespace App\Module\Person\UI\Controller\Person;

use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\UI\Api\Controller\AbstractRestController;
use App\Core\UI\Dto\Api\Response\IdDto;
use App\Core\UI\Dto\Api\Response\SuccessResponseThinDto;
use App\Module\Person\Application\Interaction\Command\UpdatePerson\UpdatePersonCommand;
use App\Module\Person\Domain\Document\Person;
use App\Module\Person\UI\Dto\PersonSaveDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateController extends AbstractRestController
{
    #[OA\Tag(name: 'Person')]
    #[OA\Put(requestBody: new OA\RequestBody(attachables: [new Model(type: PersonSaveDto::class)]))]
    #[OA\Response(
        response: 200,
        description: 'Update Person.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'responseData', ref: new Model(type: IdDto::class)),
            ],
            type: 'object',
            anyOf: [new OA\Schema(ref: new Model(type: SuccessResponseThinDto::class))]
        )
    )]
    public function update(
        Person $person,
        #[MapRequestPayload] PersonSaveDto $dto,
        CommandBusInterface $commandBus,
        ValidatorInterface $validator,
    ): Response {
        $dto->setPersonId($person->getId());
        $validationResult = $validator->validate($dto, groups: ['check_unique']);

        if ($validationResult->count() > 0) {
            return $this->json($validationResult, Response::HTTP_CONFLICT);
        }

        $id = $commandBus->dispatch(new UpdatePersonCommand($dto));

        return $this->createSuccessView('The person has been updated!', new IdDto($id));
    }
}
