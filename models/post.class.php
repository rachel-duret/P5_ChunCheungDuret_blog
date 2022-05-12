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
    public function getUser($data)
    {
        $sqlQuery = 'SELECT username, email, password FROM users WHERE email =:email ';
        $pdo = $this->connection($sqlQuery);
        $statement = $pdo->prepare($sqlQuery);
        $result = $statement->execute($data);
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
        if ($result) {
            $data = $statement->fetchAll();
            return $data;

        } else {
            return false;
        }
    }
}
