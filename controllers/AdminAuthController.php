<?php
declare(strict_types=1);

namespace app\controllers;

use app\database\UserModel;
use app\models\validation\LoginModel;
use app\renderer\Renderer;

class AdminAuthController
{

    private $database;
    private $renderer;

    public function __construct(UserModel $database, Renderer $renderer)
    {
        $this->database = $database;
        $this->renderer = $renderer;
    }

    // Admin login page
    public function loginController()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginModel = new LoginModel();
            $loginModel->getData($_POST);
            $data = [
                'email' => $_POST['email'],
            ];

            $user = $this->database->findAdmin('users', 'admin', $data);
         

            if (!$user) {
                $loginModel->addError('email', 'User does not exist with this email');

            }
            if ($user && !password_verify($_SESSION['post_data']['password'], $user->password())) {
                $loginModel->addError('password', 'Your email and password do not match, try again!');

            }
            if ($user && $user->role() !== 'admin') {

                $loginModel->addError('', 'You do not have the right to acces this page !');
            }
           
            if ($loginModel->validateData()) {

                $_SESSION['admin'] = [
                    'id'=> $user->adminId(),
                    'username' => $user->username(),
                    'role' => $user->role(),
                ];
                $_SESSION['loggedUser'] = [
                    'id'=> $user->id(),
                    'username' => $user->username(),
                    'role' => $user->role(),

                   
                ];
                header('Location:index.php?action=adminIndex');
                exit;

            }

            if (!empty($loginModel->errors)) {
                $_SESSION['post_errors'] = $loginModel->errors;

            }
            header('location:index.php?action=adminLogin');
            exit;
        }

        $content = $this->renderer-> content('./views/admin/adminLogin.php');
        require './views/template.php';

    }

     
}
