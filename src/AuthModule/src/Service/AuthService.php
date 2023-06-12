<?php

namespace AuthModule\Service;

class AuthService
{
    private array $config;
    public function __construct(
        array $config
    ) {
        $this->config = $config;
    }

    public function crypt(string $phrase)
    {
        return password_hash($phrase, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public function verify(string $plain, string $crypted)
    {
        return password_verify($plain, $crypted);
    }
}
