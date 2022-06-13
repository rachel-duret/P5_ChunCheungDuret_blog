<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
use app\entity\CommentEntity;

class CommentModel extends Database
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

        $result = $statement->execute($data);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    // Get one post
    public function findOne($table, $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT * FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
            $post = new CommentEntity($data);

            return $post;

        } else {
            return false;
        }
    }

    // Get all the post
    public function findAll($table, $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT * FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        $comments = [];
        if ($result) {
            $data = $statement->fetchAll();
            foreach ($data as $Comments) {
                /* echo '<pre>';
                var_dump($data);
                echo '</pre>'; */

                $Comment = new CommentEntity($Comments);

                $comments[] = $Comment;
                /*  echo '<pre>';
            var_dump($comments);
            echo '</pre>';
            exit; */
            }

            return $comments;
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