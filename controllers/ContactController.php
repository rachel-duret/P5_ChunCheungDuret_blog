<?php
namespace app\controllers;

require_once '../function/renderer.php';

use app\models\validation\ContactModel;

class ContactController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function handleContact()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contactModel = new ContactModel();
            $contactModel->getData($_POST);
            if ($contactModel->validateData()) {
                $data = [
                    'userId' => '3',
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'message' => $_POST['message'],
                    'date' => date('Y-m-d H:i:s'),
                ];

                $this->database->create('contact', $data);

                header('location:index.php');
                exit;

            }
            if (!empty($contactModel->errors)) {
                $_SESSION['post_errors'] = $contactModel->errors;

            }
            header('location:index.php');
            exit;
        }
        $content = content('./views/indexView.php', []);
        require './views/template.php';
    }
}