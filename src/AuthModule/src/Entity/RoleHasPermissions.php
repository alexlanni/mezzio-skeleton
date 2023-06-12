<?php

namespace AuthModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoleHasPermissions
 *
 * @ORM\Table(name="role_has_permissions", indexes={@ORM\Index(name="permission_id", columns={"permission_id"}), @ORM\Index(name="role_id", columns={"role_id"})})
 * @ORM\Entity
 */
class RoleHasPermissions
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_has_permissions_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleHasPermissionsId;

    /**
     * @var \Permission
     *
     * @ORM\ManyToOne(targetEntity="Permission")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permission_id", referencedColumnName="permission_id")
     * })
     */
    private $permission;

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
    public function getRoleHasPermissionsId(): int
    {
        return $this->roleHasPermissionsId;
    }

    /**
     * @param int $roleHasPermissionsId
     * @return RoleHasPermissions
     */
    public function setRoleHasPermissionsId(int $roleHasPermissionsId): RoleHasPermissions
    {
        $this->roleHasPermissionsId = $roleHasPermissionsId;
        return $this;
    }

    /**
     * @return Permission
     */
    public function getPermission(): Permission
    {
        return $this->permission;
    }

    /**
     * @param Permission $permission
     * @return RoleHasPermissions
     */
    public function setPermission(Permission $permission): RoleHasPermissions
    {
        $this->permission = $permission;
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
     * @return RoleHasPermissions
     */
    public function setRole(Role $role): RoleHasPermissions
    {
        $this->role = $role;
        return $this;
    }
}
