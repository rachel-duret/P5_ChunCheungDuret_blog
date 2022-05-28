<?php
session_start();
require '../controllers/authController.php';
require '../controllers/postController.php';
require_once '../controllers/ContactController.php';

$userController = new UserController();
$postController = new PostController();
$contactController = new ContactController();
if (isset($_GET['action'])) {
    /* ***********************************CREATE　POST */
    if ($_GET['action'] == 'createPost') {
        $postController->createPost();
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
        $postController->updateOnePost($post);

    }
    /* ************************DELETE ONE POST**************************************** */

    if ($_GET['action'] == 'deletePost') {
        $postController->deleteOnePost($_POST['id']);

    }

    /* **********************AUTH************************************** */
    if ($_GET['action'] == 'login') {
        $userController->loginController();

    }

    if ($_GET['action'] == 'register') {
        $userController->registerController();
        /*  echo '<pre>';
    var_dump($_SERVER["REQUEST_METHOD"]);
    echo '</pre>'; */

    }

    /* ********************Contact*************************** */

} else {
    $postController->homepage();
    $contactController->handleContact();

}