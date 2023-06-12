<?php

namespace AuthModule\Authorization;

use AuthModule\Entity\Permission;
use AuthModule\Entity\Role;
use Doctrine\ORM\EntityManager;
use Laminas\Permissions\Rbac\Rbac;
use Mezzio\Authorization\AuthorizationInterface;
use Mezzio\Router\RouteResult;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizationProvider implements AuthorizationInterface
{
    private ?Rbac $rbac;

    public function __construct(
        private EntityManager $entityManager,
        private array $config
    ) {
        $this->regenerateRbac();
    }

    private function regenerateRbac()
    {
        $this->rbac = new Rbac();
        $roleRepo = $this->entityManager->getRepository(Role::class);
        $roles = $roleRepo->findBy(
            ['enabled' => 1]
        );

        foreach ($roles as $role) {
            /** @var Role $role */
            $roleObj = new \Laminas\Permissions\Rbac\Role($role->getRoleName());
            foreach ($role->getPermissions() as $permission) {
                /** @var Permission $permission */
                $roleObj->addPermission($permission->getPermissionName());
            }
            $this->rbac->addRole($roleObj);
        }
    }

    public function isGranted(string $role, ServerRequestInterface $request): bool
    {
        $routeResult = $request->getAttribute(RouteResult::class);
        return $this->rbac->isGranted(
            $role,
            $routeResult->getMatchedRouteName()
        );
    }
}
