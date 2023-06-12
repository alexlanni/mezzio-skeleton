<?php

namespace AuthModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserHasRoles
 *
 * @ORM\Table(name="user_has_roles", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="role_id", columns={"role_id"})})
 * @ORM\Entity
 */
class UserHasRoles
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_has_roles_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userHasRolesId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     * })
     */
    private $role;

    /**
     * @return int
     */
    public function getUserHasRolesId(): int
    {
        return $this->userHasRolesId;
    }

    /**
     * @param int $userHasRolesId
     * @return UserHasRoles
     */
    public function setUserHasRolesId(int $userHasRolesId): UserHasRoles
    {
        $this->userHasRolesId = $userHasRolesId;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserHasRoles
     */
    public function setUser(User $user): UserHasRoles
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return UserHasRoles
     */
    public function setRole(Role $role): UserHasRoles
    {
        $this->role = $role;
        return $this;
    }
}
