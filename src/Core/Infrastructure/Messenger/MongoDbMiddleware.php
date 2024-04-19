<?php

namespace App\Core\Infrastructure\Messenger;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

readonly class MongoDbMiddleware implements MiddlewareInterface
{
    public function __construct(
        private DocumentManager $documentManager,
    ) {
    }

    /**
     * @throws MongoDBException
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $envelope = $stack->next()->handle($envelope, $stack);
        $this->documentManager->flush();

        return $envelope;
    }
}
