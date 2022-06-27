<?php
declare(strict_types=1);

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
    //Admin home page to show all the posts
    public function getAllPost()
    {

        $posts = $this->postDatabase->findAll('posts');
       
        $content = content('./views/admin/adminIndex.php', post:$posts);
        require './views/template.php';
    }

    // Get single post
    public function getOnePost(string $id)
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