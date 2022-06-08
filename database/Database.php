<?php
namespace app\database;

require_once '../config/config.php';
class Database
{

    protected $DB_DSN = DB_DSN;
    protected $USER = DB_USER;
    protected $PASSWORD = DB_PASSWORD;

    protected function connection()
    {
        // connect to database

        try {
            $pdo = new \PDO($this->DB_DSN, $this->USER, $this->PASSWORD);
        } catch (\Exception$error) {
            die('Erreur:' . $error->getMessage());

        }
        return $pdo;

    }

}
