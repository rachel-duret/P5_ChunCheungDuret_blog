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

    // Get one user
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
}