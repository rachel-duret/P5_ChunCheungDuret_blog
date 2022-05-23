<?php

function login()
{
    require 'loginView.php';
}
function register()
{
    require 'registerView.php';
}
function home()
{
    $posts = getPosts();
    require 'indexView.php';
}
function posts()
{
    $posts = getPosts();
    var_dump($posts);

    require 'postsView.php';
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require 'postView.php';
}
