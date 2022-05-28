<?php
class User
{
    private static $pdo;

    public function __construct()
    {

        try {
            static::$pdo = new \PDO('mysql:dbname=blog;host=localhost', 'root', 'root', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (\PDOException$e) {
            echo $e->getMessage();
            die;
        }
    }

}