<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
use app\entity\AdminEntity;
use app\entity\UserEntity;

class UserModel extends Database
{
    // Create one user to database
    public function create(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $values = str_replace(',', ', :', $keys);

        $sqlQuery = "INSERT INTO $table($keys) VALUES (:$values)";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);

        $statement->execute($data);

    }

    // Get one user from database
    public function findOne(string $table, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT id,username,email, password FROM $table WHERE $keys =:$keys ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
           
            foreach($data as $user){
                $user= new UserEntity($user);
            }
           
           

            return $user;

        } else {
            return false;
        }
    }

    /* *******************Get user admin from database********************** */
    public function findAdmin(string $table, string $table1, array $data)
    {
        $keys = implode(',', array_keys($data));

        $sqlQuery = "SELECT
         username,email, password,  users_id, role
         FROM $table INNER JOIN $table1
         ON $table.id=$table1.users_id
          WHERE $keys =:$keys  ";

        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);
        $result = $statement->execute($data);
        if ($result) {
            $data = $statement->fetchAll();
            foreach($data as $user){
                $user = new AdminEntity($user);
            }
           
            return $user;

        } else {
            return false;
        }
    }


    // get admin from database
    public function findAdminInfo(string $table, string $table1)
    {
        
        $sqlQuery = "SELECT
        username,password, users_id, image, profession, skill
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

    
}