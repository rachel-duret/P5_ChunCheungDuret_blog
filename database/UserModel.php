<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
use app\entity\AdminEntity;
use app\entity\UserEntity;

class UserModel extends Database
{
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

        $sqlQuery = "SELECT id,username,email, password FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
            $users = new UserEntity($data);

            return $users;

        } else {
            return false;
        }
    }

    /* *******************Admin********************** */
    public function findAdmin($table, $table1, $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT
         username,email, password, users_id, role
         FROM $table INNER JOIN $table1
         ON $table.id=$table1.users_id
          WHERE $keys =:$keys  ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {

            $data = $statement->fetchAll();
            $users = new UserEntity($data);
            return $users;

        } else {
            return false;
        }
    }

    public function findAdminInfo($table,$table1)
    {
        
        $sqlQuery = "SELECT
        username, users_id, image, profession, skill
        FROM $table INNER JOIN $table1
        ON $table.id=$table1.users_id  ";

       $db = $this->connection();
       $statement = $db->prepare($sqlQuery);
       $result = $statement->execute();
       if ($result) {

           $data = $statement->fetchAll();
           foreach ($data as $user) {
               $user = new AdminEntity($user);
           }
         
           return $user;

       } else {
           return false;
       }
    }

    public function updateAdmin($table,$data)
    {
        
        $sqlQuery = "UPDATE $table SET 
         image=:image, profession=:profession, skill=:skill Where id=:id";
       

       $db = $this->connection();
       $statement = $db->prepare($sqlQuery);
       $result = $statement->execute();
       if ($result) {

           $data = $statement->fetchAll();
           foreach ($data as $user) {
               $user = new AdminEntity($user);
           }
           return $user;

       } else {
           return false;
       }
    }
}