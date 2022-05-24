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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $post = $postController->updateOnePost($_POST, $_FILES);
        }
        var_dump($post);

        require 'unset_session.php';
        require 'updateView.php';

    }
    /* ************************DELETE ONE POST**************************************** */

    /* **********************AUTH************************************** */
    if ($_GET['action'] == 'login') {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->loginController($_POST);
        }
        require 'unset_session.php';
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
    $postController->homepage();
    require 'indexView.php';

}

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';