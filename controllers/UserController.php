<?php
namespace app\controllers;

require_once '../function/renderer.php';
use app\models\validation\LoginModel;
use app\models\validation\RegisterModel;

class UserController
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
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

                $this->database->create('users', $data);

                header('location:index.php?action=login');
                exit;

            }
            if (!empty($registerModel->errors)) {
                $_SESSION['post_errors'] = $registerModel->errors;

            }
            header('location:index.php?action=register');
            exit;
        }

        $content = content('./views/registerView.php', []);
        require './views/template.php';

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

            $user = $this->database->findOne('users', $data);
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

        $content = content('./views/loginView.php', []);
        require './views/template.php';

    }

    public function logoutController()
    {
       
      unset($_SESSION['loggedUser']);
      unset($_SESSION['admin']);
      
        header('Location:index.php');
        
       

    }

}