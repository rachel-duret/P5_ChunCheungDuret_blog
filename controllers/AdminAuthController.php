<?php
namespace app\controllers;

require_once '../function/renderer.php';
use app\models\validation\LoginModel;

class AdminAuthController
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

            $user = $this->database->findAdmin('users', 'admin', $data);
            echo '<pre>';
            var_dump($user);
            echo '</pre>';

            if (!$user) {
                $loginModel->addError('email', 'User does not exist with this email');

            }
            if ($user && !password_verify($_SESSION['post_data']['password'], $user->password())) {
                $loginModel->addError('password', 'Your email and password do not match, try again!');

            }
            if ($user && $user->role() !== 'admin') {

                $loginModel->addError('', 'You do not have the right to acces this page !');
            }
            /*  if ($user->role() === 'admin') {
            $loginModel->addError('email', 'You do not have the right to acces this page.');
            } */
            if ($loginModel->validateData()) {

                $_SESSION['admin'] = [
                    'username' => $user->username(),
                    'role' => $user->role(),
                ];

                header('location:index.php');
                exit;

            }

            if (!empty($loginModel->errors)) {
                $_SESSION['post_errors'] = $loginModel->errors;

            }
            header('location:index.php?action=adminLogin');
            exit;
        }

        $content = content('./views/admin/adminLogin.php', []);
        require './views/template.php';

    }

}
