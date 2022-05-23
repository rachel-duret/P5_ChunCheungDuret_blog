<?php
session_start();
require '../controllers/authController.php';
require '../controllers/postController.php';

/* require 'controller.php';
echo '<pre>';
var_dump($_GET);
echo '</pre>'; */
$userController = new UserController();
$postController = new PostController();
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        $postController->getAllPost();

    }
    if ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            echo '<pre>';
            var_dump($_GET);
            echo '</pre>';

            post();
        } else {
            echo 'Erreur ';
        }
    }
    if ($_GET['action'] == 'createPost') {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->loginController($_POST);
        }

        require 'loginView.php';

    }
    if ($_GET['action'] == 'login') {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->loginController($_POST);
        }
        require 'unset_session.php';
        /*  echo '<pre>';
        var_dump($postEorrors);
        echo '</pre>'; */

        require 'loginView.php';

    }
    if ($_GET['action'] == 'register') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->registerController($_POST);

        }
        require 'unset_session.php';
        require 'registerView.php';

    }
} else {
    $postController->getAllPost();
    require 'indexView.php';

}