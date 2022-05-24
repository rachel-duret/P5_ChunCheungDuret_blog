<?php
require_once '../Models/ErrorModel.php';
require_once '../Models/DbModel.php';
class PostController
{

    public $errors = [];
    public $posts = [];
    public $post = [];

    //register function create one new user
    public function createPost($POST, $FILES)
    {
        $image = $FILES['image'];
        $createPostModel = new CreatePostModel();
        $createPostModel->getData($POST);
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
                'title' => $POST['title'],
                'subtitle' => $POST['subtitle'],
                'content' => $POST['content'],
                'author' => $_SESSION['loggedUser']['username'],
                'date' => date('Y-m-d H:i:s'),

            ];

            $newPost->createPost($data);
            require '../views/indexView.php';

        }
        if (!empty($createPostModel->errors)) {
            $_SESSION['post_errors'] = $createPostModel->errors;

        }

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

    // Update one post
    public function updateOnePost($POST, $FILES)
    {

        $updatePostModel = new CreatePostModel();
        $updatePostModel->getData($POST);
        $image = $FILES['image'] ?? '';

        if (!is_dir('images')) {
            mkdir('images');
        }
        $imagePath = $POST['postImage'] ?? '';
        var_dump($imagePath);

        if ($image && $image['tmp_name']) {
            if ($POST['postImage']) {
                unlink($POST['postImage']);
            }

            $imagePath = 'images/' . $POST['title'] . 'update' . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);

        }
        if ($updatePostModel->validateData()) {

            $updatePost = new Post();
            $data = [
                'image' => $imagePath,
                'title' => $POST['title'],
                'subtitle' => $POST['subtitle'],
                'content' => $POST['content'],
                'author' => $_SESSION['loggedUser']['username'],
                'date' => date('Y-m-d H:i:s'),
                'id' => $POST['id'],

            ];

            $updatePost->updateOnePost($data);
            require '../views/indexView.php';

        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

        }

    }

    //Delete one post
    public function deleteOnePost($id)
    {
        $deletePost = new Post;
        $data = [
            'id' => $id,
        ];
        $deletePost->deleteOnePost($data);
        header('location: posts.php');
    }

}
