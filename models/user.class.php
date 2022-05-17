<?php
require_once 'database.class.php';

class User extends Database
{
    protected $username;
    protected $email;
    protected $password;

// Create one user
    public function createUser($username, $email, $password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sqlQuery = 'INSERT INTO users(username, email, password) VALUES (:username, :email, :password)';
        $db = $this->connection();
        $statement = $db->prepare($sqlQuery);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashPassword,
        ];
        $statement->execute($data);

    }

    // Get one user
    public function getUser($data)
    {
        $sqlQuery = 'SELECT username, email, password FROM users WHERE email =:email ';
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
}