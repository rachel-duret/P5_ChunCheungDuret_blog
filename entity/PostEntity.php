<?php
declare (strict_types = 1);
namespace app\entity;

class PostEntity
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
        foreach ($data as $post) {
            /*  echo '<pre>';
            var_dump($post);
            echo '</pre>';
            exit; */

            $this->id = $post['id'];
            $this->image = $post['image'];
            $this->title = $post['title'];
            $this->subtitle = $post['subtitle'];
            $this->content = $post['content'];
            $this->author = $post['author'];
            $this->date = $post['date'];

        }
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