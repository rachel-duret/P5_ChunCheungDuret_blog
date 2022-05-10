<?php
session_start();
include 'config.php';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
$username = '';
$email = '';
$password = '';
$confirmPassword = '';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require './oop/user.php';
    $newUser = new UserContr;
    $errors = $newUser->register($_POST);
    header('location: register.php');
    exit;
}

require './oop/unset_session.php';

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
    <?php include_once 'header.php';?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="<?php echo isset($postErrors) ? 'register.php' : 'login.php' ?>" method="post">
                        <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                            <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        echo $postError . '<br>';
    }
}?>

                        </div>


                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Username</label>
                            <input type="text"
                                class="form-control <?php echo isset($_SESSION['post_errors']['username']) ? 'is-invalid' : '' ?>"
                                id="validationServer03" aria-describedby="validationServer03Feedback" name="username"
                                minlength="4" value="<?php echo $postData['username'] ?? ''; ?>">
                        </div>

                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Email</label>
                            <input type="email"
                                class="form-control <?php echo isset($_SESSION['post_errors']['email']) ? 'is-invalid' : '' ?>"
                                id="validationServer03" aria-describedby="validationServer03Feedback" name="email"
                                value="<?php echo $postData['email'] ?? '' ?>">

                        </div>

                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Password</label>
                            <input type="password"
                                class="form-control <?php echo isset($_SESSION['post_errors']['password']) ? 'is-invalid' : '' ?>"
                                id="validationServer03" aria-describedby="validationServer03Feedback" name="password"
                                minlength="6" value="<?php echo $postData['password'] ?? ''; ?>">

                        </div>

                        <div class="mb-3 row">
                            <label for="validationServer03" class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control <?php echo isset($_SESSION['post_errors']['confirmPassword']) ? 'is-invalid' : '' ?>"
                                id="validationServer03" aria-describedby="validationServer03Feedback"
                                name="confirmPassword" value="<?php echo $postData['confirmPassword'] ?? ''; ?>">

                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <?php include_once 'footer.php';?>


</body>


</html>