<?php
session_start();
require '../controllers/authController.php';
require '../controllers/postController.php';

$userController = new UserController();
$postController = new PostController();
if (isset($_GET['action'])) {
    /* ***********************************CREATE　POST */
    if ($_GET['action'] == 'createPost') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $postController->createPost($_POST, $_FILES);
            header('location:index.php?action=createPost');
            exit;
        }
        require 'unset_session.php';
        require 'createView.php';

    }
/* **************************ALL POSTS********************************* */
    if ($_GET['action'] == 'posts') {
        $postController->getAllPost();

    }

    /* ************************SINGLE POST******************** */
    if ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postController->getOnePost($_GET['id']);
        }
    }
/* *************************UPDATE*********************************************8 */

    if ($_GET['action'] == 'updatePost' && isset($_GET['id']) && $_GET['id'] > 0) {
        $post = $postController->post($_GET['id']);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $postController->updateOnePost($_POST, $_FILES);
            header('location:index.php?action=updatePost&id=' . $post['id']);
            exit;
        }

        require 'unset_session.php';
        require 'updateView.php';

    }
    /* ************************DELETE ONE POST**************************************** */

    if ($_GET['action'] == 'deletePost') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $postController->deleteOnePost($_POST['id']);
            header('location:index.php?action=Posts');
            exit;
        }

    }
    /* **********************AUTH************************************** */
    if ($_GET['action'] == 'login') {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->loginController($_POST);
            header('location:index.php?action=login');
            exit;
        }
        require 'unset_session.php';
        require 'loginView.php';

    }
    if ($_GET['action'] == 'register') {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->registerController($_POST);
            header('location:index.php?action=register');
            exit;
        }
        require 'unset_session.php';

        require 'registerView.php';

    }
} else {
    $postController->homepage();

}

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';