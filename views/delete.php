<?php
require '../controllers/post.controller.php';
$id = $_POST['id'];
if (!$id) {
    header('location: posts.php');

}

$delete = new PostController();
$deleteOnePost = $delete->deleteOnePost($id);

header('location: posts.php');
