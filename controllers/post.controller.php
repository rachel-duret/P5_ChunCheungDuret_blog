<?php
include '../models/post.class.php';
class PostController
{

    const ERROR_TITLE_REQUIRED = 'Title is required !';
    const ERROR_SUBTITLE_REQUIRED = 'Subtitle is required !';
    const ERROR_CONTENT_REQUIRED = 'Content is required !';
    const ERROR_AUTHOR_REQUIRED = 'You have to login fisrt !';

    private $errors = [];
    private $posts = [];

    //register function create one new user
    public function createPost($POST, $FILES)
    {
        echo '<pre>';
        var_dump($POST, $FILES);
        echo '</pre>';
        $image = $FILES['image'] ?? '';
        $title = $POST['title'];
        $subtitle = $POST['subtitle'];
        $content = $POST['content'];
        $author = $_SESSION['loggedUser']['username'] ?? '';
        $date = date('Y-m-d H:i:s');

        if (!$title) {
            $this->errors['title'] = self::ERROR_TITLE_REQUIRED;
        }
        if (!$subtitle) {
            $this->errors['subtitle'] = self::ERROR_SUBTITLE_REQUIRED;

        }
        if (!$content) {
            $this->errors['content'] = self::ERROR_CONTENT_REQUIRED;
        }
        if (!$author) {
            $this->errors['author'] = self::ERROR_AUTHOR_REQUIRED;
        }

        $_SESSION['post_data'] = [
            'image' => $image ?? '',
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'author' => $_SESSION['loggedUser']['username'] ?? '',
            'date' => date('Y-m-d H:i:s'),
        ];

        if (!is_dir('images')) {
            mkdir('images');
        }
        $imagePath = '';
        if ($image && $image['tmp_name']) {

            echo '<pre>';
            var_dump($FILES);
            echo '</pre>';
            $imagePath = 'images/' . $_POST['title'] . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        if (!empty($this->errors)) {
            $_SESSION['post_errors'] = $this->errors;

        } else {

            $newPost = new Post();
            $data = [
                'image' => $imagePath,
                'title' => $title,
                'subtitle' => $subtitle,
                'content' => $content,
                'author' => $author,
                'date' => $date,

            ];

            $newPost->createPost($data);
            header('location: posts.php');
            exit;
        }

        return $this->errors;

    }

    // Get all the posts
    public function getAllPost()
    {
        $allPost = new Post();
        $posts = $allPost->getAllPost();
        return $this->posts = $posts;

    }

}