<?php

declare (strict_types = 1);
namespace app\entity;

class UserEntity
{
    private $id;
    private $email;
    private $username;
    private $password;
    private $role;

    public function __construct(array $data)
    {
        foreach ($data as $user) {

            $this->id = $user['id'];
            $this->email = $user['email'];
            $this->username = $user['username'];
            $this->password = $user['password'];

        }
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
    public function role()
    {
        return $this->role;
    }

    public function password()
    {
        return $this->password;
    }

}