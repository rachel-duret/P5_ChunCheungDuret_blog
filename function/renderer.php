<?php

function content(string $viewPath, $post = null, $comments = null)
{
    /*  echo '<pre>';
    var_dump($comments);
    echo '</pre>'; */

    $postData = [];
    $postErrors = [];
    if (array_key_exists('post_errors', $_SESSION) && array_key_exists('post_data', $_SESSION)) {

        $postData = $_SESSION['post_data'];
        $postErrors = $_SESSION['post_errors'];

        unset($_SESSION['post_errors'], $_SESSION['post_data']);
    }
    ob_start();
    require $viewPath;
    return ob_get_clean();
}
