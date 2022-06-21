<?php
session_start();

require_once '../vendor/autoload.php';

use app\controllers\AdminAuthController;
use app\controllers\AdminController;
use app\controllers\CommentController;
use app\controllers\ContactController;
use app\controllers\CVController;
use app\controllers\PostController;
use app\controllers\UserController;
use app\database\CommentModel;
use app\database\PostModel;
use app\database\UserModel;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$commentModel = new CommentModel;

$userController = new UserController($database = new UserModel());
$postController = new PostController($database = new PostModel(), $commentModel);
$commentController = new CommentController($commentModel);
$adminAuthController = new AdminAuthController($database = new UserModel());
$adminController = new AdminController($database = new PostModel());
$cvController = new CVController();
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

    if ($_GET['action'] == 'login') {
        $userController->loginController();

    }

    if ($_GET['action'] == 'register') {
        $userController->registerController();

    }

    if ($_GET['action'] == 'logout') {
        $userController->LogoutController();

    }
    if ($_GET['action'] == 'cv') {
       $cvController->cv();

    }

    /* **********************Admin******************************** */
    if ($_GET['action'] == 'adminLogin') {
        $adminAuthController->loginController();

    }

    if ($_GET['action'] == 'adminIndex') {
        $adminController->getAllPost();

    }
    if ($_GET['action'] == 'profileUpdate') {
        $adminController->updateProfile();

    }



    /* ********************Contact*************************** */

} else {
    /*   $postController->homepage(); */
    $userController->findAdminInfo();

}