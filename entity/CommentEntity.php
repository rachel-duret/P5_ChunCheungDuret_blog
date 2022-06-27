<?php

declare (strict_types = 1);
namespace app\entity;

class CommentEntity
{
    private string $id;
    private string $post_id;
    private string $users_id;
    private string $username;
    private string $comment;
    private string $date;
    private string $validation;

    public function __construct(array $data)
    {

        $this->id = $data['id'];
        $this->post_id = $data['post_id'];
        $this->users_id = $data['users_id'];
        $this->username = $data['username'];
        $this->comment = $data['comment'];
        $this->date = $data['date'];
        $this->validation = $data['validation'];

    }

    public function id()
    {
        return $this->id;
    }

    public function post_id()
    {
        return $this->post_id;
    }

    public function users_id()
    {
        return $this->users_id;
    }

    public function username()
    {
        return $this->username;
    }

    public function comment()
    {
        return $this->comment;
    }

    public function date()
    {
        return $this->date;
    }

    public function validation()
    {
        return $this->validation;
    }

}