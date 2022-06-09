<?php

declare (strict_types = 1);
namespace app\entity;

class UserEntity
{
    private $id;
    private $email;
    private $username;
    private $password;

    public function __construct(string $id, string $email, string $username, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

}