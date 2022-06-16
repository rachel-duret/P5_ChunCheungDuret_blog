<?php
namespace app\controllers;

use app\models\validation\CreateCommentModel;

require_once '../function/renderer.php';

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

    // Get all the posts
    public function getAllComments($id)
    {

        $data = [
            'postId' => $id,
        ];
        $comments = $this->database->findAll('comments', $data);

        $content = content('./views/postView.php', [], $comments);
        echo '<pre>';
        var_dump($content);
        echo '</pre>';

        require './views/template.php';

    }

    //Get one post
    public function getOneComment($id)
    {

        $data = [
            'id' => $id,
        ];
        $comment = $this->database->findOne('comments', $data);

        $content = content('./views/postView.php', $comment);
        require './views/template.php';
    }

    //Delete one comment
    public function deleteOneComment($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'id' => $id,
            ];
            $this->database->deleteOne('comments', $data);
            header('location:index.php?action=posts');
            exit;

        }
        header('location:index.php?action=post&id=' . $id);
        exit;

    }

}