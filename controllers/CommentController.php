<?php
namespace app\controllers;

use app\models\validation\CreateCommentModel;


class CommentController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function createComment()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $createCommentModel = new CreateCommentModel();
            $createCommentModel->getData($_POST);

            if ($createCommentModel->validateData()) {
                $data = [
                    'postId' => $_POST['id'],
                    'userId' => $_SESSION['loggedUser']['id'],
                    'username' => $_SESSION['loggedUser']['username'],
                    'comment' => $_POST['comment'],
                    'date' => date('Y-m-d H:i:s'),

                ];

                $this->database->create('comments', $data);

                header('location:index.php?action=post&id=' . $_POST['id']);
                exit;

            }
            if (!empty($createCommentModel->errors)) {
                $_SESSION['post_errors'] = $createCommentModel->errors;

            }
            header('location:index.php?action=post&id=' . $_POST['id']);
            exit;
        }

        $content = content('./views/postView.php');
        require './views/template.php';

    }

    //Get one post
    public function updateOneComment($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
            'id' => $id,
        ];
            $comment = $this->database->updateOne('comments', $data);
       

            header('Location:index.php?action=adminPost&id='.$_POST['postId']);
            exit;
        }
        header('Location:index.php?action=adminPost&id='.$_POST['postId']);
        exit;
    }

    //Delete one comment
    public function deleteOneComment($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'id' => $id,
            ];
            $this->database->deleteOne('comments', $data);
            header('Location:index.php?action=adminPost&id='.$_POST['postId']);
            exit;

        }
        header('Location:index.php?action=adminPost&id='.$_POST['postId']);
        exit;

    }

}