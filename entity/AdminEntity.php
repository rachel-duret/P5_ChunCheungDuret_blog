<?php

declare (strict_types = 1);
namespace app\entity;

class AdminEntity
{
    private string $id;
    private string $username;
    private string $image;
    private string $profession;
    private string $skill;

    public function __construct(array $data)
    {

     /*    echo '<pre>';
            var_dump($data);
            echo '</pre>';
            exit;    */
            $this->username = $data['username'];
            $this->id = $data['users_id'] ;
            $this->image = $data['image'];
            $this->profession = $data['profession'];
            $this->skill = $data['skill'];

        
    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function username()
    {
        return $this->username;
    }
    public function profession()
    {
        return $this->profession;
    }

    public function skill()
    {
        return $this->skill;
    }

}