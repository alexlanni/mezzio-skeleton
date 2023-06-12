<?php

namespace AuthModule\Factory;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Mezzio\Application;
use Mezzio\Authentication\AuthenticationMiddleware;
use Mezzio\Authentication\OAuth2\TokenEndpointHandler;
use Mezzio\Authorization\AuthorizationMiddleware;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Helper\ServerUrlMiddleware;
use Mezzio\Helper\UrlHelperMiddleware;
use Mezzio\Router\Middleware\DispatchMiddleware;
use Mezzio\Router\Middleware\ImplicitHeadMiddleware;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\Middleware\RouteMiddleware;
use Psr\Container\ContainerInterface;

class PipelineAndRoutesDelegator
{
    public function __invoke(
        ContainerInterface $container,
        string $serviceName,
        callable $callback
    ): Application {
        /** @var $app Application */
        $app = $callback();



        // Setup pipeline:
        $app->pipe(ErrorHandler::class);
        $app->pipe(ServerUrlMiddleware::class);
        $app->pipe(\Mezzio\Session\SessionMiddleware::class);
        $app->pipe(RouteMiddleware::class);
        $app->pipe(AuthenticationMiddleware::class);
        $app->pipe(AuthorizationMiddleware::class);
        $app->pipe(ImplicitHeadMiddleware::class);
        $app->pipe(ImplicitOptionsMiddleware::class);
        $app->pipe(MethodNotAllowedMiddleware::class);
        $app->pipe(UrlHelperMiddleware::class);
        $app->pipe(DispatchMiddleware::class);
        $app->pipe(NotFoundHandler::class);

        // Setup routes:
        $app->post(
            '/api/login',
            \AuthModule\Handler\LoginHandler::class,
            'api.login'
        );

        $app->get(
            '/api/health-check',
            [
                \AuthModule\Handler\HealthCheckHandler::class
            ],
            'api.health-check'
        );

        $app->get(
            '/unauthorized',
            [
                \AuthModule\Handler\UnauthorizedHandler::class
            ],
            'unauthorized'
        );


        return $app;
    }
}
