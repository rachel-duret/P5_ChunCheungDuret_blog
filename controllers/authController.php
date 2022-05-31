<?php

require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';
require_once '../function/renderer.php';

class UserController
{
    private $postData = [];
    private $postErrors = [];

    //register function create one new user
    public function registerController()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $registerModel = new RegisterModel();
            $registerModel->getData($_POST);
            if ($registerModel->validateData()) {
                $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $data = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $hashPassword,
                ];
                $newUser = new User('users', $data);
                $newUser->create();

                header('location:index.php?action=login');
                exit;

            }
            if (!empty($registerModel->errors)) {
                $_SESSION['post_errors'] = $registerModel->errors;

            }
            header('location:index.php?action=register');
            exit;
        }

        $content = content('../views/registerView.php', []);
        require '../views/template.php';

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
            $user = new User('users', $data);
            $user = $user->findOne();

            if (!$user) {
                $loginModel->addError('email', 'User does not exist with this email');

            }
            if ($user && !password_verify($_SESSION['post_data']['password'], $user[0]['password'])) {
                $loginModel->addError('password', 'Your password is incorrect, try again!');

            }
            if ($loginModel->validateData()) {
                $_SESSION['loggedUser'] = [
                    'id' => $user[0]['id'],
                    'username' => $user[0]['username'],
                    'email' => $user[0]['email'],

                ];

                header('location:index.php');
                exit;

            }

            if (!empty($loginModel->errors)) {
                $_SESSION['post_errors'] = $loginModel->errors;

            }
            header('location:index.php?action=login');
            exit;
        }

        $content = content('../views/loginView.php', []);
        require '../views/template.php';

    }

}