<?php
namespace app\controllers;

use app\database\CommentModel;
use app\database\PostModel;

class AdminController
{
    private  $postDatabase;
    private $commentDatabase;

    public function __construct(PostModel $postDatabase, CommentModel $commentDatabase)
    {
        $this->postDatabase = $postDatabase;
        $this->commentDatabase = $commentDatabase;
     
    }
    //Get all post
    public function getAllPost()
    {

        $posts = $this->postDatabase->findAll('posts');
        $content = content('./views/admin/adminIndex.php', post:$posts);
        require './views/template.php';
    }

    // Get one post
    public function getOnePost($id)
    {

        $data = [
            'id' => $id,
        ];
        $post = $this->postDatabase->findOne('posts', $data);
        $comments = $this->commentDatabase->adminFindAll('comments',$data);

        $content = content('./views/admin/adminPost.php', post:$post, comments:$comments);
        require './views/template.php';
    }

   
    
}