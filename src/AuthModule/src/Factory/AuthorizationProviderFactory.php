<?php

namespace AuthModule\Factory;

use AuthModule\Authentication\AuthenticationProvider;
use AuthModule\Authorization\AuthorizationProvider;
use AuthModule\Service\AuthService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class AuthorizationProviderFactory
{
    public function __invoke(ContainerInterface $container): AuthorizationProvider
    {
        $em = $container->get(EntityManager::class);
        $config = $container->get('config')['authorization'];
        return new AuthorizationProvider(
            $em,
            $config
        );
    }
}
