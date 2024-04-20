<?php

namespace App\Module\Message\Application\Interaction\Event\MessageCreated\Handler;

use App\Core\Infrastructure\Bus\SharedEventBusInterface;
use App\Module\Message\Application\Interaction\Event\MessageCreated\MessageCreatedEvent;
use App\Shared\Application\Interaction\SharedEvent\MessageCreatedSharedEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

readonly class DispatchSharedEventHandler
{
    public function __construct(
        private SharedEventBusInterface $sharedEventBus,
    ) {
    }

    #[AsMessageHandler(bus: 'event_bus')]
    public function handle(MessageCreatedEvent $event): void
    {
        $this->sharedEventBus->dispatch(new MessageCreatedSharedEvent($event->messageId));
    }
}
