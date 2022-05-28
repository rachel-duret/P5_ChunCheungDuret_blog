<?php
require_once '../models/ErrorModel.php';

class ContactController
{
    public function handleContact()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contactModel = new ContactModel();
            $contactModel->getData($_POST);
            if ($contactModel->validateData()) {
                $contact = new Contact();
                $data = [
                    'userId' => $_SESSION['loggedUser']['id'],
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'message' => $_POST['message'],
                    'date' => date('d/m/y'),
                ];

                $result = $contact->save($data);
                if ($result) {
                    return 'Your message is sended !';
                }
                header('location:index.php');
                exit;

            }
            if (!empty($contactModel->errors)) {
                $_SESSION['post_errors'] = $contactModel->errors;

            }

        }

        require '../views/unset_session.php';
        require '../views/index.php';
    }
}