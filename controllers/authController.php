<?php

require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';

class UserController
{
    public $error;
    //register function create one new user
    public function registerController()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $registerModel = new RegisterModel();
            $registerModel->getData($_POST);
            if ($registerModel->validateData()) {
                $newUser = new User;

                $newUser->createUser($_POST['username'], $_POST['email'], $_POST['password'], );

                header('location:index.php?action=login');
                exit;

            }
            if (!empty($registerModel->errors)) {
                $_SESSION['post_errors'] = $registerModel->errors;

            }
            header('location:index.php?action=register');
            exit;
        }

        require '../views/unset_session.php';
        require '../views/registerView.php';

    }

    //login function
    public function loginController()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginModel = new LoginModel();
            $loginModel->getData($_POST);
            $user = new User;
            $data = [
                'email' => $_POST['email'],
            ];

            $user = $user->findOneUser($data);

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
        require '../views/unset_session.php';
        require '../views/loginView.php';

    }

}