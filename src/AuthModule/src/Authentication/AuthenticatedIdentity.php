<?php

namespace AuthModule\Authentication;

use AuthModule\Entity\Role;
use AuthModule\Entity\User;
use Mezzio\Authentication\UserInterface;

class AuthenticatedIdentity implements UserInterface
{
    public mixed $identity;

    public mixed $userId;

    public array $roles;

    public array $details;

    private bool $isGuest = false;

    public function __construct(mixed $userDetails = null)
    {
        if ($userDetails instanceof User) {
            $this->identity = $userDetails->getUsername();
            $this->userId = $userDetails->getUserId();
            $roles = $userDetails->getRoles();
            if ($userDetails->getUserId() == User::GUEST_USER_ID) {
                $this->isGuest = true;
            }
            foreach ($roles as $role) {
                /** @var Role $role */
                $this->roles[] = $role->getRoleName();
            }
        }

        if (is_array($userDetails)) {
            $this->identity = $userDetails['identity'] ?? null;
            $this->roles = $userDetails['roles'] ?? [];
            $this->userId = $userDetails['userId'] ?? User::GUEST_USER_ID;
            $this->isGuest = $this->userId == User::GUEST_USER_ID;
        }
    }

    /**
     * @return mixed
     */
    public function getUserId(): mixed
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return AuthenticatedIdentity
     */
    public function setUserId(mixed $userId): AuthenticatedIdentity
    {
        $this->userId = $userId;
        return $this;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function getRoles(): iterable
    {
        return $this->roles;
    }

    public function getDetail(string $name, $default = null)
    {
        return ($this->details[$name]) ?? $default;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return $this->isGuest;
    }
}
