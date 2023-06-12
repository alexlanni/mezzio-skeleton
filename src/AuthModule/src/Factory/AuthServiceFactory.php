<?php

namespace AuthModule\Factory;

use AuthModule\Authentication\AuthenticationProvider;
use AuthModule\Service\AuthService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class AuthServiceFactory
{
    public function __invoke(ContainerInterface $container): AuthService
    {
        $config = $container->get('config')['authentication'];

        return new AuthService(
            $config
        );
    }
}
