<?php

declare (strict_types = 1);
namespace app\entity;

class AdminEntity
{
    private string $id;
    private string $adminId;
    private string $username;
    private string $password;
    private string $image;
    private string $profession;
    private string $skill;
    private string $role;
    

    public function __construct(array $data)
    {  
            $this->username = $data['username'];
            $this->id = $data['users_id'] ;
            $this->adminId = $data['aid'];
            $this->password = $data['password'];
            $this->image = $data['image']??'';
            $this->profession = $data['profession']?? '';
            $this->skill = $data['skill']?? '';
            $this->role = $data['role']??'';

        
    }

    public function id()
    {
        return $this->id;
    }

    public function adminId()
    {
        return $this->adminId;
    }

    public function image()
    {
        return $this->image;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }
    
    public function profession()
    {
        return $this->profession;
    }

    public function skill()
    {
        return $this->skill;
    }

    public function role()
    {
        return $this->role;
    }

}
