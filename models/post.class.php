<?php
require 'database.class.php';

class Post extends Database
{
    protected $username;
    protected $email;
    protected $password;

// Create one post
    public function createPost($data)
    {

        $sqlQuery = 'INSERT INTO posts( image, title, subtitle, content, author, date ) VALUES ( :image, :title, :subtitle, :content, :author, :date)';
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $statement->execute($data);

    }

    // Get all the post
    public function getAllPost()
    {
        $sqlQuery = 'SELECT * FROM posts ORDER BY date DESC';
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute();
        if ($result) {
            $data = $statement->fetchAll();
            return $data;

        } else {
            return false;
        }
    }

    //Get a single post

    public function getOnePost($data)
    {
        $sqlQuery = 'SELECT * FROM posts WHERE id=:id ';
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    //Update one post
    public function updateOnePost($data)
    {
        $sqlQuery = 'UPDATE posts SET image=:image, title=:title, subtitle=:subtitle, content=:content, author=:author,date=:date WHERE id=:id';
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $statement->execute($data);
    }
}