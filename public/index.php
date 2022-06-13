<?php
session_start();

require_once '../vendor/autoload.php';

use app\controllers\AdminController;
use app\controllers\CommentController;
use app\controllers\ContactController;
use app\controllers\PostController;
use app\controllers\UserController;
use app\database\CommentModel;
use app\database\Model;
use app\database\PostModel;
use app\database\UserModel;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$userController = new UserController($database = new UserModel());
$postController = new PostController($database = new PostModel());
$commentController = new CommentController($database = new CommentModel());
$contactController = new ContactController($database = new Model());
$adminController = new AdminController($database = new UserModel());
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
            $commentController->getAllComments($_GET['id']);
        }
    }
    /* *************************Comments*********************************************8 */
    if ($_GET['action'] == 'createComment') {
        $commentController->createComment();
    }

/* *************************UPDATE*********************************************8 */

    if ($_GET['action'] == 'updatePost' && isset($_GET['id']) && $_GET['id'] > 0) {
        $postController->updateOnePost($_GET['id']);

    }
    /* ************************DELETE ONE POST**************************************** */

    if ($_GET['action'] == 'deletePost') {
        $postController->deleteOnePost($_POST['id']);

    }

    /* **********************AUTH************************************** */
    if ($_GET['action'] == 'adminLogin') {
        $adminController->loginController();

    }

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
    /*   $postController->homepage(); */
    $contactController->handleContact();

}