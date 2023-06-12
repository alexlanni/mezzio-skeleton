<?php

declare(strict_types=1);

namespace AuthModule\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class UnauthorizedHandlerFactory
{
    public function __invoke(ContainerInterface $container): UnauthorizedHandler
    {
        return new UnauthorizedHandler($container->get(TemplateRendererInterface::class));
    }
}
