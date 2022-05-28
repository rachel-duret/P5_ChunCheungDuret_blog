<?php
require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';
class PostController
{

    public $errors = [];
    public $posts = [];
    public $post = [];

    //register function create one new user
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

                $newPost = new Post();
                $data = [
                    'image' => $imagePath,
                    'title' => $_POST['title'],
                    'subtitle' => $_POST['subtitle'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['loggedUser']['username'],
                    'date' => date('Y-m-d H:i:s'),

                ];

                $newPost->createPost($data);
                header('location:index.php?action=posts');
                exit;
            }
            if (!empty($createPostModel->errors)) {
                $_SESSION['post_errors'] = $createPostModel->errors;

            }

            header('location:index.php?action=createPost');
            exit;
        }
        require '../views/unset_session.php';
        require '../views/createView.php';

    }

    public function homepage()
    {
        $allPost = new Post();
        $posts = $allPost->getAllPost();

        require '../views/indexView.php';
    }

    // Get all the posts
    public function getAllPost()
    {
        $allPost = new Post();
        $posts = $allPost->getAllPost();
        require '../views/postsView.php';
    }

    //Get one post
    public function getOnePost($id)
    {
        $singlePost = new Post();
        $data = [
            'id' => $id,
        ];
        $post = $singlePost->getOnePost($data);
        require '../views/postView.php';
    }

    public function post($id)
    {
        $singlePost = new Post();
        $data = [
            'id' => $id,
        ];
        return $singlePost->getOnePost($data);
    }

    // Update one post
    public function updateOnePost($post)
    {

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

                $updatePost = new Post();
                $data = [
                    'image' => $imagePath,
                    'title' => $_POST['title'],
                    'subtitle' => $_POST['subtitle'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['loggedUser']['username'],
                    'date' => date('Y-m-d H:i:s'),
                    'id' => $_POST['id'],

                ];

                $updatePost->updateOnePost($data);
                header('location:index.php?action=posts');
                exit;

            } else {
                $_SESSION['post_errors'] = $updatePostModel->errors;

            }
            header('location:index.php?action=updatePost&id=' . $post['id']);
            exit;
        }

        require 'unset_session.php';
        require 'updateView.php';

    }

    //Delete one post
    public function deleteOnePost($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $deletePost = new Post;
            $data = [
                'id' => $id,
            ];
            $deletePost->deleteOnePost($data);
            header('location:index.php?action=posts');
            exit;

        }
        header('location:index.php?action=post&id=' . $id);
        exit;

    }

}