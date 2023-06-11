<?php

declare(strict_types=1);

namespace AuthModule\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class HealthCheckHandlerFactory
{
    public function __invoke(ContainerInterface $container) : HealthCheckHandler
    {
        return new HealthCheckHandler($container->get(TemplateRendererInterface::class));
    }
}
