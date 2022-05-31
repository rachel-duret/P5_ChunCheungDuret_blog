<?php
require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';
require_once '../function/renderer.php';
class PostController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function createPost()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $image = $_FILES['image'];
            $createPostModel = new CreatePostModel();
            $createPostModel->getData($_POST);
            if (!is_dir('images')) {
                mkdir('images');
            }
            $imagePath = '';
            if ($image && $image['tmp_name']) {

                $imagePath = 'images/' . $_POST['title'] . '/' . $image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            if ($createPostModel->validateData()) {

                $data = [
                    'image' => $imagePath,
                    'title' => $_POST['title'],
                    'subtitle' => $_POST['subtitle'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['loggedUser']['username'],
                    'date' => date('Y-m-d H:i:s'),

                ];

                $this->database->create('posts', $data);
                header('location:index.php?action=posts');
                exit;
            }
            if (!empty($createPostModel->errors)) {
                $_SESSION['post_errors'] = $createPostModel->errors;

            }

            header('location:index.php?action=createPost');
            exit;
        }

        $content = content('../views/createView.php', []);
        require '../views/template.php';

    }

    // Get all the posts
    public function getAllPost()
    {

        $posts = $this->database->findAll('posts');
        $content = content('../views/postsView.php', $posts);
        require '../views/template.php';
    }

    //Get one post
    public function getOnePost($id)
    {

        $data = [
            'id' => $id,
        ];
        $post = $this->database->findOne('posts', $data);

        $content = content('../views/postView.php', $post);
        require '../views/template.php';
    }

    // Update one post
    public function updateOnePost($id)
    {

        $data = [
            'id' => $id,
        ];

        $postData = $this->database->findOne('posts', $data, );

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $updatePostModel = new CreatePostModel();
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

                $this->database->updateOne('posts', $data);
                header('location:index.php?action=posts');
                exit;

            } else {
                $_SESSION['post_errors'] = $updatePostModel->errors;

            }
            header('location:index.php?action=updatePost&id=' . $postData['id']);
            exit;
        }

        $content = content('../views/updateView.php', $postData);
        require '../views/template.php';

    }

    //Delete one post
    public function deleteOnePost($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'id' => $id,
            ];
            $this->database->deleteOne('posts', $data);
            header('location:index.php?action=posts');
            exit;

        }
        header('location:index.php?action=post&id=' . $id);
        exit;

    }

}
