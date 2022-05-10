<?php
require 'user.class.php';

class UserContr
{
    private $errors = [];
    private $postData = [];
    private $postErrors = [];

    //register function create one new user
    public function register($POST)
    {
        $username = $POST["username"];
        $email = $POST["email"];
        $password = $POST["password"];
        $confirmPassword = $POST["confirmPassword"];

        if (!$username) {
            $errors['username'] = 'Username is required !';

            //to  check username length
        } else if (strlen($username) < 4 || strlen($username) > 16) {

            $errors['username'] = 'Username must be in between 4 and 16 characters !';
        }

        if (!$email) {
            $errors['email'] = 'Email is required !';

            // to check email format
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Must be valid email address !';
        }

        if (!$password) {
            $errors['password'] = 'Password is required !';
        }

        if (!$confirmPassword) {
            $errors['confirmPassword'] = ' Confirm password is required !';
        } else if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = " Your confirm password is filed, try again .";
        }

        $_SESSION['post_data'] = [
            'username' => $POST['username'],
            'email' => $POST['email'],
            'password' => $POST['password'],
            'confirmPassword' => $POST['confirmPassword'],

        ];

        if (!empty($errors)) {
            $_SESSION['post_errors'] = $errors;

        } else {
            $newUser = new User;
            $newUser->createUser($username, $email, $password);

            header('location: login.php');
            exit;
        }
        return $this->errors = $errors;
        header('location: register.php');
        exit;
    }

    //login function
    public function login($POST)
    {
        $user = new User;
        $data = [];
        $users = $user->getUser($data);
        $_SESSION['post_data'] = [

            'email' => $POST['email'],
            'password' => $POST['password'],

        ];

        foreach ($users as $user) {
            if ($_SESSION['post_data']['email'] !== $user['email'] || !password_verify($_SESSION['post_data']['password'], $user['password'])) {
                $errors['loginError'] = 'Your email or password do not match !';

            } else {
                $_SESSION['loggedUser'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],

                ];

                header('location: index.php');
                exit;
            }
        }

        if (!empty($errors)) {
            $_SESSION['post_error'] = $errors;

        }
        return $this->errors = $errors;

    }

}
