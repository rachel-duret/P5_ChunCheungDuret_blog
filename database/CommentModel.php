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

        $sqlQuery = "SELECT * FROM $table WHERE postId =:$keys AND validation=1  ORDER BY date DESC ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        $comments = [];
        if ($result) {
            $data = $statement->fetchAll();
            foreach ($data as $Comments) {
               
                $Comment = new CommentEntity($Comments);

                $comments[] = $Comment;
              
            }
            

            return $comments;
        } else {
            return false;
        }
    }

    public function adminFindAll($table, $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT * FROM $table WHERE postId =:$keys   ORDER BY date DESC ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        $comments = [];
        if ($result) {
            $data = $statement->fetchAll();
           
            foreach ($data as $Comments) {
               
                $Comment = new CommentEntity($Comments);

                $comments[] = $Comment;
              
            }
            

            return $comments;
        } else {
            return false;
        }
    }
    //Update one post
    public function updateOne($table, $data)
    {

        $sqlQuery = "UPDATE $table  SET validation = 1 WHERE id=:id ";
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
          
        } else {
            return false;
        }

    }

}