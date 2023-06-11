<?php

namespace AuthModule\Hal\Entity;

class LoginResource
{
    public string $sessionId;

    public int $userId;

    public string $userName;

    public string $email;

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     * @return LoginResource
     */
    public function setSessionId(string $sessionId): LoginResource
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return LoginResource
     */
    public function setUserId(int $userId): LoginResource
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return LoginResource
     */
    public function setUserName(string $userName): LoginResource
    {
        $this->userName = $userName;
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
     * @return LoginResource
     */
    public function setEmail(string $email): LoginResource
    {
        $this->email = $email;
        return $this;
    }

}