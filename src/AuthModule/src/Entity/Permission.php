<?php

namespace AuthModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table(name="permission", uniqueConstraints={@ORM\UniqueConstraint(name="uq_permission", columns={"permission_name"})})
 * @ORM\Entity
 */
class Permission
{
    /**
     * @var int
     *
     * @ORM\Column(name="permission_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $permissionId;

    /**
     * @var string
     *
     * @ORM\Column(name="permission_name", type="string", length=50, nullable=false)
     */
    private $permissionName;

    /**
     * @return int
     */
    public function getPermissionId(): int
    {
        return $this->permissionId;
    }

    /**
     * @param int $permissionId
     * @return Permission
     */
    public function setPermissionId(int $permissionId): Permission
    {
        $this->permissionId = $permissionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    /**
     * @param string $permissionName
     * @return Permission
     */
    public function setPermissionName(string $permissionName): Permission
    {
        $this->permissionName = $permissionName;
        return $this;
    }
}
