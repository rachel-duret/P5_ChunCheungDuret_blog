<?php
namespace app\models;

class Database
{
    protected $HOST = 'localhost';
    protected $DB_NAME = 'blog';
    protected $USER = 'root';
    protected $PASSWORD = 'root';

    protected function connection()
    {
        // connect to database
        $string = "mysql:host=$this->HOST; dbname=$this->DB_NAME";

        try {
            $pdo = new \PDO($string, $this->USER, $this->PASSWORD);
        } catch (\Exception$error) {
            die('Erreur:' . $error->getMessage());

        }
        return $pdo;

    }

}