<?php

namespace AuthModule\Factory;

use AuthModule\Authentication\AuthenticationProvider;
use AuthModule\Service\AuthService;
use Doctrine\ORM\EntityManager;
use Mezzio\Authentication\UserInterface;
use Mezzio\ProblemDetails\ProblemDetailsResponseFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class AuthenticationProviderFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationProvider
    {
        $config = $container->get('config')['authentication'];
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        $user = $container->get(UserInterface::class);
        $em = $container->get(EntityManager::class);
        $authService = $container->get(AuthService::class);
        $problemDetailsFactory = $container->get(ProblemDetailsResponseFactory::class);

        return new AuthenticationProvider(
            $config,
            $responseFactory,
            $user,
            $em,
            $authService,
            $problemDetailsFactory
        );
    }
}
