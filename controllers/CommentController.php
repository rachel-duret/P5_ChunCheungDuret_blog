<?php
declare(strict_types=1);

namespace app\controllers;

use app\database\CommentModel;
use app\models\validation\CreateCommentModel;
use app\renderer\Renderer;

class CommentController
{
    private $database;
    private $renderer;

    public function __construct(CommentModel $database)
    {
        $this->database = $database;
    }

    // Create one comment
    public function createComment()
    {
        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {

            $createCommentModel = new CreateCommentModel();
            $createCommentModel->getData($_POST);

            if ($createCommentModel->validateData()) {
                $data = [
                    'post_id' => $_POST['id'],
                    'users_id' => $_SESSION['loggedUser']['id'],
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

        $content =Renderer::content('./views/postView.php');
        require './views/template.php';

    }

    //Admin valid one comment
    public function updateOneComment(string $id)
    {
        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
            'id' => $id,
        ];
            $comment = $this->database->updateOne('comments', $data);
       

            header('Location:index.php?action=adminPost&id='.$_POST['post_id']);
            exit;
        }
        header('Location:index.php?action=adminPost&id='.$_POST['post_id']);
        exit;
    }

    //Delete one comment
    public function deleteOneComment(string $id)
    {
        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'id' => $id,
            ];
            $this->database->deleteOne('comments', $data);
            header('Location:index.php?action=adminPost&id='.$_POST['post_id']);
            exit;

        }
        header('Location:index.php?action=adminPost&id='.$_POST['post_id']);
        exit;

    }

}
