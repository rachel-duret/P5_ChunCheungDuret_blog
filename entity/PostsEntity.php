<?php
declare (strict_types = 1);
namespace app\entity;

class PostsEntity
{
    private $id;
    private $image;
    private $title;
    private $subtitle;
    private $content;
    private $author;
    private $date;

    public function __construct(array $data)
    {

        $this->id = $data['id'];
        $this->image = $data['image'];
        $this->title = $data['title'];
        $this->subtitle = $data['subtitle'];
        $this->content = $data['content'];
        $this->author = $data['author'];
        $this->date = $data['date'];

    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function title()
    {
        return $this->title;
    }

    public function subtitle()
    {
        return $this->subtitle;
    }

    public function content()
    {
        return $this->content;
    }

    public function author()
    {
        return $this->author;
    }

    public function date()
    {
        return $this->date;
    }

}