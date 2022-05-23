<?php

require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';

class UserController
{
    public $error;
    //register function create one new user
    public function registerController($POST)
    {

        $registerModel = new RegisterModel();
        $registerModel->getData($POST);
        if ($registerModel->validateData()) {
            $newUser = new User;

            $newUser->createUser($POST['username'], $POST['email'], $POST['password'], );
            var_dump($this->data);

            require '../views/loginView.php';

        }
        if (!empty($registerModel->errors)) {
            $_SESSION['post_errors'] = $registerModel->errors;

        }

        require '../views/registerView.php';
    }

    //login function
    public function loginController($POST)
    {
        $loginModel = new LoginModel();
        $loginModel->getData($POST);
        $user = new User;
        $data = [
            'email' => $POST['email'],
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

            require '../views/indexView.php';

        }

        if (!empty($loginModel->errors)) {
            $_SESSION['post_errors'] = $loginModel->errors;
            echo '<pre>';
            var_dump($_SESSION['post_errors']);
            echo '</pre>';

        }

    }

}