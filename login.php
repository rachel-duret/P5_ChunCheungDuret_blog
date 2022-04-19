<?php 
session_start();
echo session_id().'<br>';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
$users = [
    [
        'email'=> 'rachel@gmail',
        'password'=> '000000'
    ],
    [
        'email' => 'lara@gmail.com',
        'password' => '999999'
    ],
    [
        'email' => 'florent@gmail.com',
        'password' => '000000'
    ]

];

$email = '';
$loginError = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['email']) && isset($_POST['password'])){
    foreach($users as $user){
        if($user['email']===$_POST['email'] && $user['password']===$_POST['password']){
            $_SESSION['LOGGED_USER'] = $user['email'];
            echo $_SESSION['LOGGED_USER'].'session';
        }else{
            $loginError = 'Your email or password do not match !';
        }
    }
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
                    <form action="<?php echo isset($_SESSION['LOGGED_USER'])?  'index.php' : '' ?>" method="post">
                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Email</label>
                            <input type="email" class="form-control " id="validationServer03"
                                aria-describedby="validationServer03Feedback" name="email" value="<?php echo $email ?>">
                        </div>
                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Password</label>
                            <input type="password"
                                class="form-control <?php echo isset($loginError) ? 'is-invalid' : '' ?>"
                                id="validationServer03" aria-describedby="validationServer03Feedback" name="password">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?php echo $loginError ? : '' ; ?>
                            </div>
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