<?php

declare (strict_types = 1);
namespace app\entity;

class CommentEntity
{
    private string $id;
    private string $postId;
    private string $usersId;
    private string $username;
    private string $comment;
    private string $date;
    private string $validation;

    public function __construct(array $data)
    {

        $this->id = $data['id'];
        $this->postId = $data['post_id'];
        $this->usersId = $data['users_id'];
        $this->username = $data['username'];
        $this->comment = $data['comment'];
        $this->date = $data['date'];
        $this->validation = $data['validation'];

    }

    public function id()
    {
        return $this->id;
    }

    public function postId()
    {
        return $this->postId;
    }

    public function usersId()
    {
        return $this->usersId;
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
