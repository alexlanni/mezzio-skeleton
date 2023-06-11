<?php

declare(strict_types=1);

namespace AuthModule\Handler;

use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LoginHandler
    {
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);

        $config = $container->get('config');

        print_r($config);
        die;

        return new LoginHandler(
            $container->get(TemplateRendererInterface::class),
            $resourceGenerator,
            $responseFactory
        );
    }
}
