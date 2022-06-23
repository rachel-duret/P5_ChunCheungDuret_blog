<?php

declare (strict_types = 1);
namespace app\entity;

class UserEntity
{
    private string $id;
    private string $email;
    private string $username;
    private string $password;
 

    public function __construct(array $data)
    {
            $this->id = $data['id'] ;
            $this->email = $data['email'];
            $this->username = $data['username'];
            $this->password = $data['password'];

    
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