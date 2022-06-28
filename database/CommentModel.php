<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
use app\entity\CommentEntity;

class CommentModel extends Database
{

// Create one comment into database
    public function create(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $values = str_replace(',', ', :', $keys);

        $sqlQuery = "INSERT INTO $table($keys) VALUES (:$values)";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);

        $result = $statement->execute($data);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    // Get one comment from database
    public function findOne(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT id, post_id, users_id, username, comment, date, validation FROM $table WHERE $keys =:$keys ";

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

    // Get all the validate comment from database 
    public function findAll(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT  id, post_id, users_id, username, comment, date, validation FROM $table WHERE post_id =:$keys AND validation=1  ORDER BY date DESC ";

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


    //Get all the comments from database for admin 
    public function adminFindAll(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT  id, post_id, users_id, username, comment, date, validation FROM $table WHERE post_id =:$keys   ORDER BY date DESC ";

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
    

    // Validate update comment to database
    public function updateOne(string $table, array $data)
    {

        $sqlQuery = "UPDATE $table  SET validation = 1 WHERE id=:id ";
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $statement->execute($data);

    }

    //Admin delete one commment
    public function deleteOne(string $table, array $data)
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
