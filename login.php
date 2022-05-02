<?php 
session_start();
include('config.php');
echo session_id().'<br>';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';



$sqlQuery = 'SELECT * FROM users';
$usersStatement = $db->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

$email = '';
$loginError = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
    $_SESSION['post_data'] =[
      
        'email'=>$_POST['email'],
        'password'=>$_POST['password'],
        
    ];
  
    foreach($users as $user){
        if( $_SESSION['post_data']['email'] !==$user['email'] ||  ! password_verify($_SESSION['post_data']['password'], $user['password'])){
            $loginError = 'Your email or password do not match !';
           
        }else{
            $_SESSION['loggedUser'] =[
                'id'=>$user['id'],
                'username'=>$user['username'],
                'email'=>$user['email'],
               
                
            ];
            
            header('location: index.php');
            exit;
        }
    }
    
    if(!empty($loginError)){
        $_SESSION['post_error']=$loginError;
    
       }
        header('location: login.php');
        exit;
    
    
}


$postError ='';
$postData = [];
if (array_key_exists('post_error', $_SESSION)){
  
    $postError = $_SESSION['post_error'];
    $postData = $_SESSION['post_data'];

    unset($_SESSION['post_error'], $_SESSION['post_data']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My Blog</title>
</head>

<body>
    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="<?php echo $postError? 'alert alert-danger' : '' ?>">
                        <div><?php echo $postError; ?></div>
                    </div>
                    <form action="<?php echo isset($_SESSION['LOGGED_USER'])?  'index.php' : '' ?>" method="post">
                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Email</label>
                            <input type="email" class="form-control " id="validationServer03"
                                aria-describedby="validationServer03Feedback" name="email"
                                value="<?php echo $postData['email']?? '' ?>">
                        </div>
                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Password</label>
                            <input type="password" class="form-control" id="validationServer03"
                                aria-describedby="validationServer03Feedback" name="password">

                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </form>
                </div>
                <div class="col">
                    2 of 2
                </div>
            </div>
        </div>

    </div>
    <?php include_once('footer.php'); ?>


</body>

</html>