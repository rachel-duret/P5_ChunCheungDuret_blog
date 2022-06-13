<?php
namespace app\controllers;

require_once '../function/renderer.php';
use app\models\validation\LoginModel;

class AdminController
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    //login function
    public function loginController()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginModel = new LoginModel();
            $loginModel->getData($_POST);
            $data = [
                'email' => $_POST['email'],
            ];

            $user = $this->database->findOne('admin', $data);
            echo '<pre>';
            var_dump($user);
            echo '</pre>';

            if (!$user) {
                $loginModel->addError('email', 'User does not exist with this email');

            }
            if ($user && !password_verify($_SESSION['post_data']['password'], $user->password())) {
                $loginModel->addError('password', 'Your password is incorrect, try again!');

            }
            if ($loginModel->validateData()) {

                $_SESSION['loggedUser'] = [
                    'id' => $user->id(),
                    'username' => $user->username(),
                    'email' => $user->email(),
                    'role' => $user->role(),
                ];
                var_dump($_SESSION);
                exit;
                header('location:index.php');
                exit;

            }

            if (!empty($loginModel->errors)) {
                $_SESSION['post_errors'] = $loginModel->errors;

            }
            header('location:index.php?action=adminLogin');
            exit;
        }

        $content = content('./views/adminLogin.php', []);
        require './views/template.php';

    }

}