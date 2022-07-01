<?php
session_start();

require_once '../vendor/autoload.php';


use app\controllers\AdminAuthController;
use app\controllers\AdminController;
use app\controllers\CommentController;
use app\controllers\CvController;
use app\controllers\PageNotFound;
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

$userController = new UserController( new UserModel(), new Renderer());
$postController = new PostController( new PostModel(), $commentModel,  new Renderer());
$commentController = new CommentController($commentModel,  new Renderer());
$adminAuthController = new AdminAuthController(new UserModel(), new Renderer());
$adminController = new AdminController($database = new PostModel(),  $commentModel, new Renderer);
$cvController = new CvController();


if (isset($_GET['action'])) {
    /* ***********************************CREATE　POST */
    if ($_GET['action'] == 'createPost') {
        if( isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin'){
            $postController->createPost();
        } else {
            PageNotFound::page404();
        }
       
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
    if ($_GET['action'] == 'createComment' ) {
        if( isset($_SESSION['loggedUser'])){
            $commentController->createComment();
        } else {
            PageNotFound::page404();
        }
       
    }

/* *************************UPDATE*********************************************8 */

    if ($_GET['action'] == 'updatePost' && isset($_SESSION['admin']) ) {
        if(isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin' && isset($_GET['id']) && $_GET['id'] > 0){
            $postController->updateOnePost($_GET['id']);
        }else {
            PageNotFound::page404();
        }
     

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

    /* **********************Admin ******************************** */
    //admin Login
    if ($_GET['action'] == 'adminLogin') {
        $adminAuthController->loginController();

    }

    // admin Home page
    if ($_GET['action'] == 'adminIndex' ) {
        if(isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin'){
            $adminController->getAllPost();
        }else{
            PageNotFound::page404();
        }
        

    }
    
    // Admin Get one post
    if ($_GET['action'] == 'adminPost' && isset($_SESSION['admin'])) {
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin' && isset($_GET['id']) && $_GET['id'] > 0) {
            $adminController->getOnePost($_GET['id']);
           
        } else {
            PageNotFound::page404();
        }

    }

    // Admin update valid one comment
    
    if ($_GET['action'] == 'validComment') {
        if(isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin'){
            $commentController->updateOneComment($_POST['id']);

        }else{
            PageNotFound::page404();
        }
      
    }

    //Admin Delete one comment
     
    if ($_GET['action'] == 'deleteComment') {
        if(isset($_SESSION['admin']) && $_SESSION['admin']['role']=='admin'){
            $commentController->deleteOneComment($_POST['id']);
        }else{
            PageNotFound::page404();
        }
    }
} else {
   /* ********************Home page Contact*************************** */
    $userController->findAdminInfo();

}
