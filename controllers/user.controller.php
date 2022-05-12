<?php

require '../models/user.class.php';

class UserController
{

    const ERROR_UERNAME_REQUIRED = 'Username is required !';
    const ERROR_EMAIL_REQUIRED = 'Email is required !';
    const ERROR_PASSWORD_REQUIRED = 'Password is required !';
    const ERROR_CONFIRM_PASSWORD_REQUIRED = 'Confirm password is required ! ';
    const ERROR_UERNAME_NOT_VALID = 'Username must be in between 4 to 16 caractters !';
    const ERROR_EMAIL_NOT_VALID = 'Email must be valid email address !';
    const ERROR_PASSWORD_NOT_VALID = 'Your confirm password is filed, try again !';
    const ERROR_LOGIN_NOT_VALID = 'Your email and  password is do not match, try again !';
    private $errors = [];

    //register function create one new user
    public function register($POST)
    {
        $username = $POST["username"];
        $email = $POST["email"];
        $password = $POST["password"];
        $confirmPassword = $POST["confirmPassword"];

        if (!$username) {
            $this->errors['username'] = self::ERROR_UERNAME_REQUIRED;

            //to  check username length
        } else if (strlen($username) < 4 || strlen($username) > 16) {

            $this->errors['username'] = self::ERROR_UERNAME_NOT_VALID;
        }

        if (!$email) {
            $this->errors['email'] = self::ERROR_EMAIL_REQUIRED;

            // to check email format
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = self::ERROR_EMAIL_NOT_VALID;
        }

        if (!$password) {
            $this->errors['password'] = self::ERROR_PASSWORD_REQUIRED;
        }

        if (!$confirmPassword) {
            $this->errors['confirmPassword'] = self::ERROR_CONFIRM_PASSWORD_REQUIRED;
        } else if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = self::ERROR_PASSWORD_NOT_VALID;
        }

        $_SESSION['post_data'] = [
            'username' => $POST['username'],
            'email' => $POST['email'],
            'password' => $POST['password'],
            'confirmPassword' => $POST['confirmPassword'],

        ];

        if (!empty($this->errors)) {
            $_SESSION['post_errors'] = $this->errors;

        } else {
            $newUser = new User;
            $newUser->createUser($username, $email, $password);

            header('location: login.php');
            exit;
        }
        return $this->errors;

    }

    //login function
    public function login($POST)
    {
        $user = new User;
        $data = [
            'email' => $POST['email'],
        ];
        $userData = $user->getUser($data);
        $_SESSION['post_data'] = [

            'email' => $POST['email'],
            'password' => $POST['password'],

        ];

        foreach ($userData as $user) {
            if ($_SESSION['post_data']['email'] !== $user['email'] || !password_verify($_SESSION['post_data']['password'], $user['password'])) {
                $this->errors['loginError'] = self::ERROR_LOGIN_NOT_VALID;

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

        if (!empty($this->errors)) {
            $_SESSION['post_errors'] = $this->errors;

        }
        return $this->errors;

    }

}
