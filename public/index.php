<?php
session_start();

require_once '../vendor/autoload.php';


use app\controllers\AdminAuthController;
use app\controllers\AdminController;
use app\controllers\CommentController;
use app\controllers\CvController;
use app\controllers\PostController;
use app\controllers\UserController;
use app\database\CommentModel;
use app\database\PostModel;
use app\database\UserModel;
use app\renderer\Renderer;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
require '../config/config.php';
$commentModel = new CommentModel;

$userController = new UserController($database = new UserModel(), new Renderer());
$postController = new PostController($database = new PostModel(), $commentModel,  new Renderer());
$commentController = new CommentController($commentModel,  new Renderer());
$adminAuthController = new AdminAuthController($database = new UserModel(), new Renderer());
$adminController = new AdminController($database = new PostModel(),  $commentModel, new Renderer);
$cvController = new CvController();
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
    
    // Get one post
    if ($_GET['action'] == 'adminPost') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $adminController->getOnePost($_GET['id']);
           
        }

    }

    //update valid one comment
    
    if ($_GET['action'] == 'validComment') {
        $commentController->updateOneComment($_POST['id']);

    }

    //Delete one comment
     
    if ($_GET['action'] == 'deleteComment') {
        $commentController->deleteOneComment($_POST['id']);

    }
    



    /* ********************Contact*************************** */

} else {
  
    $userController->findAdminInfo();

}