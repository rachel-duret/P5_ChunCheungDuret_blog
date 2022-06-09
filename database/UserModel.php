<?php
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

            foreach ($data as $data) {
                $id = $data['id'];
                $email = $data['email'];
                $username = $data['username'];
                $password = $data['password'];
                $users = new UserEntity($id, $email, $username, $password);
            }

            /*   echo '<pre>';
            var_dump($users);
            echo '</pre>';
            exit; */
            return $users;

        } else {
            return false;
        }
    }
}