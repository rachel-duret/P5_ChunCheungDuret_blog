<?php
namespace app\controllers;

use app\database\PostModel;
use app\models\validation\AdminModel;

require_once '../function/renderer.php';

class AdminController
{
    private  $postDatabase;

    public function __construct(PostModel $postDatabase)
    {
        $this->postDatabase = $postDatabase;
     
    }
    //Get one post
    public function getAllPost()
    {

        $posts = $this->postDatabase->findAll('posts');
        $content = content('./views/admin/adminIndex.php', $posts);
        require './views/template.php';
    }

    //Update profile
    public function updateProfile()
    {
        $data = [
            'id' => $_SESSION['admin']['id'],
        ];

        $postData = $this->postDatabase->findOne('posts', $data, );

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $updatePostModel = new AdminModel();
            $updatePostModel->getData($_POST);
            $image = $_FILES['image'] ?? '';

            if (!is_dir('images')) {
                mkdir('images');
            }
            $imagePath = $_POST['postImage'] ?? '';
            var_dump($imagePath);

            if ($image && $image['tmp_name']) {
                if ($_POST['postImage']) {
                    unlink($_POST['postImage']);
                }

                $imagePath = 'images/' . $_POST['title'] . 'update' . '/' . $image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);

            }
            if ($updatePostModel->validateData()) {

                $data = [
                    'image' => $imagePath,
                    'title' => $_POST['title'],
                    'subtitle' => $_POST['subtitle'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['loggedUser']['username'],
                    'date' => date('Y-m-d H:i:s'),
                    'id' => $_POST['id'],

                ];

                $this->postDatabase->updateOne('posts', $data);
                header('location:index.php?action=posts');
                exit;

            } else {
                $_SESSION['post_errors'] = $updatePostModel->errors;

            }
            header('location:index.php?action=updatePost&id=' . $postData['id']);
            exit;
        }

        $content = content('./views/updateView.php', $postData);
        require './views/template.php';

    }
    
}