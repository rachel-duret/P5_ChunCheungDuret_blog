<?php
// Connect to Database
try {
    $db = new PDO('mysql:host=localhost;dbname=blog','root','root');
} 
catch (Exception $error) 
{
    die('Erreur:' . $error->getMessage());
}

// send one request
$postsStatement = $db->prepare('SELECT * FROM posts');
$postsStatement->execute();
$posts = $postsStatement->fetchAll();

// Submit contact form
echo '<pre>';
var_dump($_POST);
echo '</pre>';
$firstName = '';
$lastName = '';
$email = '';
$message = '';


$errors =[];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

$firstName = $_POST["first_name"] ;
$lastName = $_POST['last_name'];
$email = $_POST["email"];
$message = $_POST["message"];
}

if(!$firstName) {
    $errors['firstName'] = 'First name is required !'; 

    //to  check username length 
}else if(strlen($firstName) < 4 || strlen($firstName) > 16 ){
    
    $errors['firstName'] = 'First name must be in between 4 and 16 characters !';
}

if(!$lastName) {
    $errors['lastName'] = 'Last name is required !'; 

    //to  check username length 
}else if(strlen($lastName) < 4 || strlen($lastName) > 16 ){
    
    $errors['lastName'] = 'Last name must be in between 4 and 16 characters !';
}

if(!$email) {
    $errors['email'] = 'Email is required !';

    // to check email format
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Must be valid email address !';
}

if(!$message) {
    $errors['message'] = 'Message is required !';
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
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <img src="./images/photo1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Rachel Duret</h5>
                            <p class="card-text">
                                Full-stack web developer: PHP - Javascript - ReactJS - Node.JS
                            </p>
                            <a href="#" class="btn btn-primary">Watch my CV</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="accordion" id="accordionExample">
                        <?php foreach($posts as $post ) { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo $post['title']; ?>
                                   
                                </button>
                                <p><?php echo  $post['subtitle'];?></p>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                   <?php echo $post['content'];?>
                                   <p><?php echo $post['author'];?></p>
                                   <p><?php echo $post['date'];?></p>

                                </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary">Left</button>
                        <button type="button" class="btn btn-primary">Middle</button>
                        <button type="button" class="btn btn-primary">Right</button>
                    </div>
                </div>
                <div class="col-sm-8">
                    <form action="" method="post" >
                         <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Frsit Name</label>
                            <input type="text" class="form-control  <?php echo isset($errors['firstName']) ? 'is-invalid' : '' ?>" id="exampleFormControlInput1"
                                placeholder="First name" name="first_name" value="<?php echo $firstName ?>" >
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?php echo $errors['firstName'] ? : '' ; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                            <input type="text" class="form-control <?php echo isset($errors['lastName']) ? 'is-invalid' : '' ?>" id="exampleFormControlInput1"
                                placeholder="Last name" name="last_name" value="<?php echo $lastName ?>" >
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?php echo $errors['lastName'] ? : '' ; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email </label>
                            <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>" id="exampleFormControlInput1"
                                placeholder="name@example.com" name="email" value="<?php echo $email ?>" >
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?php echo $errors['email'] ? : '' ; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>" id="exampleFormControlTextarea1" rows="3" name="message" value="<?php echo $message ?>" ></textarea>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?php echo $errors['message'] ? : '' ; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Send</button>
                    </form>

                </div>
            </div>
        </div>

    </div>



    <?php include_once('footer.php'); ?>

</body>

</html>