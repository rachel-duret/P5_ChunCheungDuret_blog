<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
use app\entity\PostEntity;


class PostModel extends Database
{

// Create one post to database
    public function create(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $values = str_replace(',', ', :', $keys);

        $sqlQuery = "INSERT INTO $table($keys) VALUES (:$values)";
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);

        $statement->execute($data);

    }

    // Get one post from database
    public function findOne(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT id, image, title, subtitle, content, author, date  FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
            foreach ($data as $post) {
                $post = new PostEntity($post);
            }
            return $post;

        } else {
            return false;
        }
    }

    // Get all the post from database
    public function findAll(string $table)
    {
        $sqlQuery = "SELECT id, image, title, subtitle, content, author, date  FROM $table ORDER BY date DESC";
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute();
        $posts = [];
        if ($result) {
            $data = $statement->fetchAll();
            foreach ($data as $post) {
                

                $Post = new PostEntity($post);
               
                $posts[] = $Post;
            
            }

            return $posts;
        } else {
            return false;
        }
    }

    //Update one post from database
    public function updateOne(string $table, array $data)
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

    //Delete one post from database
    public function deleteOne(string $table, array $data)
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