<?php
declare(strict_types=1);

namespace app\controllers;



use app\database\CommentModel;
use app\database\PostModel;
use app\models\validation\CreatePostModel;
use app\renderer\Renderer;

class PostController
{
    private  $postDatabase;
    private  $commentDatabase;
    private $renderer;

    public function __construct(PostModel $postDatabase, CommentModel $commentDatabase, Renderer $renderer)
    {
        $this->postDatabase = $postDatabase;
        $this->commentDatabase = $commentDatabase;
        $this->renderer = $renderer;
    }

    // Create one post
    public function createPost()
    {
        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {
            $image =isset($_FILES['image']);
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
                    'author' => $_SESSION['admin']['username'],
                    'date' => date('Y-m-d H:i:s'),
                    'admin_id'=>$_SESSION['admin']['id'],

                ];

                $this->postDatabase->create('posts', $data);
                header('location:index.php?action=adminIndex');
                exit;
            }
            if (!empty($createPostModel->errors)) {
                $_SESSION['post_errors'] = $createPostModel->errors;

            }

            header('location:index.php?action=createPost');
            exit;
        }

        $content =$this->renderer-> content('./views/createView.php');
        require './views/template.php';

    }

    // Get all the posts
    public function getAllPost()
    {

        $posts = $this->postDatabase->findAll('posts');
        $content =$this->renderer-> content('./views/postsView.php', post: $posts);
        require './views/template.php';
    }

    //Get one post
    public function getOnePost(string $id)
    {

        $data = [
            'id' => $id,
        ];
        $post = $this->postDatabase->findOne('posts', $data);
        $comments = $this->commentDatabase->findAll('comments',$data);

        $content =$this->renderer-> content('./views/postView.php', post:$post, comments:$comments);
        require './views/template.php';
    }

    // Update one post
    public function updateOnePost(string $id)
    {

        $data = [
            'id' => $id,
        ];

        $post = $this->postDatabase->findOne('posts', $data, );

        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {
            $updatePostModel = new CreatePostModel();
            $updatePostModel->getData($_POST);
            $image = $_FILES['image'] ?? '';

            if (!is_dir('images')) {
                mkdir('images');
            }
            $imagePath = $_POST['postImage'] ?? '';
         

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
                    'admin_id'=>$_SESSION['admin']['id'],
                    'image' => $imagePath,
                    'title' => $_POST['title'],
                    'subtitle' => $_POST['subtitle'],
                    'content' => $_POST['content'],
                    'author' => $_SESSION['admin']['username'],
                    'date' => date('Y-m-d H:i:s'),
                    'id' => $_POST['id'],

                ];

                $this->postDatabase->updateOne('posts', $data);
                header('location:index.php?action=adminIndex');
                exit;

            } else {
                $_SESSION['post_errors'] = $updatePostModel->errors;

            }
            header('location:index.php?action=updatePost&id=' . $post->id());
            exit;
        }

        $content =$this->renderer-> content('./views/updateView.php', post:$post);
        require './views/template.php';

    }

    //Delete one post
    public function deleteOnePost(string $id)
    {
        if (isset($_SERVER["REQUEST_METHOD"] )&& $_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'id' => $id,
            ];
            $this->postDatabase->deleteOne('posts', $data);
            header('location:index.php?action=adminIndex');
            exit;

        }
        header('location:index.php?action=post&id=' . $id);
        exit;

    }

}
