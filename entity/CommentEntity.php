<?php

declare (strict_types = 1);
namespace app\entity;

class CommentEntity
{
    private $id;
    private $postId;
    private $userId;
    private $username;
    private $comment;
    private $date;

    public function __construct(array $data)
    {

        $this->id = $data['id'];
        $this->postId = $data['postId'];
        $this->userId = $data['userId'];
        $this->username = $data['username'];
        $this->comment = $data['comment'];
        $this->date = $data['date'];

    }

    public function id()
    {
        return $this->id;
    }

    public function postId()
    {
        return $this->postId;
    }

    public function userId()
    {
        return $this->userId;
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

}