<?php
namespace app\controllers;

require_once '../function/renderer.php';

class AdminController
{

    //Get one post
    public function getAll()
    {

        /*   $data = [
        'id' => $id,
        ];
        $post = $this->database->findOne('posts', $data); */
        $content = content('./views/admin/adminIndex.php', []);
        require './views/template.php';

    }
}