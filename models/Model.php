<?php
namespace app\models;

use app\models\Database;

class Model extends Database
{

// Create one user
    public function create($table, $data)
    {
        $keys = implode(',', array_keys($data));

        $values = str_replace(',', ', :', $keys);

        $sqlQuery = "INSERT INTO $table($keys) VALUES (:$values)";

        var_dump($sqlQuery);

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);

        $statement->execute($data);

    }

    // Get one user
    public function findOne($table, $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT * FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
            return $data;

        } else {
            return false;
        }
    }

    // Get all the post
    public function findAll($table)
    {
        $sqlQuery = "SELECT * FROM $table ORDER BY date DESC";
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

    //Update one post
    public function updateOne($table, $data)
    {
        $setSql = '';
        foreach (array_keys($data) as $key) {
            $setSql .= "$key=:$key,";

        }

        $setSql = substr_replace($setSql, ' ', -8);

        $sqlQuery = "UPDATE $table  SET $setSql WHERE id=:id ";
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $statement->execute($data);

    }

    //Delete one post
    public function deleteOne($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $sqlQuery = "DELETE FROM $table WHERE $keys=:$keys";
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            return true;
            header('location:posts.php');
            exit;
        } else {
            return false;
        }

    }

}

/* class Post extends Database
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

//Delete one post
public function deleteOnePost($data)
{
$sqlQuery = 'DELETE FROM posts WHERE id=:id';
$db = $this->connection();
$statement = $db->prepare($sqlQuery);
$result = $statement->execute($data);
if ($result) {
return true;
header('location:posts.php');
exit;
} else {
return false;
}

}
}

class Contact extends Database
{
public function save($data)
{
$sqlQuery = 'INSERT INTO contact(userId, first_name, last_name, email, message, date ) VALUES ( :userId,:first_name, :last_name, :email, :message, :date)';
$db = $this->connection();
$statement = $db->prepare($sqlQuery);
$statement->execute($data);
}
} */