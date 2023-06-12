<?php

namespace AuthModule\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", uniqueConstraints={@ORM\UniqueConstraint(name="uq_role_name", columns={"role_name"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=40, nullable=false)
     */
    private $roleName;

    /**
     * @var int
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false, options={"default"="1"})
     */
    private $enabled = 1;

    /**
     * @var Collection<Permission>
     *
     * @ORM\ManyToMany(targetEntity="Permission")
     * @ORM\JoinTable(name="role_has_permissions",
     *  joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="permission_id", unique=true)}
     *  )
     */
    private $permissions;

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return Role
     */
    public function setRoleId(int $roleId): Role
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     * @return Role
     */
    public function setRoleName(string $roleName): Role
    {
        $this->roleName = $roleName;
        return $this;
    }

    /**
     * @return int
     */
    public function getEnabled(): int
    {
        return $this->enabled;
    }

    /**
     * @param int $enabled
     * @return Role
     */
    public function setEnabled(int $enabled): Role
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @param Collection $permissions
     * @return Role
     */
    public function setPermissions(Collection $permissions): Role
    {
        $this->permissions = $permissions;
        return $this;
    }
}
