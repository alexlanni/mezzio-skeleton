<?php

declare(strict_types=1);

namespace AuthModule;

use AuthModule\Authorization\AuthorizationProvider;
use AuthModule\Factory\AuthorizationProviderFactory;
use Laminas\Hydrator\ObjectPropertyHydrator;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authorization\AuthorizationInterface;
use Mezzio\Hal\Metadata\MetadataMap;
use Mezzio\Hal\Metadata\RouteBasedResourceMetadata;

/**
 * The configuration provider for the AuthModule module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            MetadataMap::class => [
                [
                    '__class__' => RouteBasedResourceMetadata::class,
                    'resource_class' => Hal\Entity\LoginResource::class,
                    'route' => 'api.login',
                    'extractor' => ObjectPropertyHydrator::class
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                Authentication\AuthenticationProvider::class => Factory\AuthenticationProviderFactory::class,
                AuthorizationProvider::class => AuthorizationProviderFactory::class,
                Service\AuthService::class => Factory\AuthServiceFactory::class,
                Handler\LoginHandler::class => Handler\LoginHandlerFactory::class,
                Handler\HealthCheckHandler::class => Handler\HealthCheckHandlerFactory::class,
                Handler\UnauthorizedHandler::class => Handler\UnauthorizedHandlerFactory::class,
            ],
            'aliases' => [
                AuthenticationInterface::class => Authentication\AuthenticationProvider::class,
                AuthorizationInterface::class => Authorization\AuthorizationProvider::class
            ],
            'delegators' => [
                \Mezzio\Application::class => [
                    Factory\PipelineAndRoutesDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'auth-module'    => [__DIR__ . '/../templates/'],
                'error' => [__DIR__ . '/../templates/error/'],
                'layout' => [__DIR__ . '/../templates/layout/'],
            ],
        ];
    }
}
