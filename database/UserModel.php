<?php
declare (strict_types = 1);
namespace app\database;

use app\database\Database;
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
          username,email, password, role
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
}