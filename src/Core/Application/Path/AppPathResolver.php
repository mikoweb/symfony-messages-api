<?php

namespace App\Core\Application\Path;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use function Symfony\Component\String\u;

final readonly class AppPathResolver
{
    public function __construct(
        private ParameterBagInterface $parameterBag
    ) {
    }

    public function getAppPath(?string $path = null): string
    {
        return $this->concatPath($this->parameterBag->get('kernel.project_dir'), $path);
    }

    public function concatPath(string $basePath, ?string $path): string
    {
        if (empty($path)) {
            return $basePath;
        }

        if (u($path)->startsWith('/')) {
            $path = u($path)->slice(1)->toString();
        }

        return "$basePath/$path";
    }
}
