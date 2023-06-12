<?php

namespace AuthModule\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="uq_email", columns={"email"}), @ORM\UniqueConstraint(name="uq_username", columns={"username"})})
 * @ORM\Entity
 */
class User
{
    public const GUEST_USER_ID = 1;
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=1024, nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = '0';

    /**
     * @var Collection<Role>
     *
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_has_roles",
     *  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id", unique=true)}
     *  )
     */
    private $roles;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function setUserId(int $userId): User
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getEnabled(): int|string
    {
        return $this->enabled;
    }

    /**
     * @param int|string $enabled
     * @return User
     */
    public function setEnabled(int|string $enabled): User
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @param Collection $roles
     * @return User
     */
    public function setRoles(Collection $roles): User
    {
        $this->roles = $roles;
        return $this;
    }
}
