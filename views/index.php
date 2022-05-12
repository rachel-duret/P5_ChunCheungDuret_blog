<?php
session_start();
include 'config.php';

$sqlQuery = 'SELECT * FROM posts';
// send one request
$postsStatement = $db->prepare($sqlQuery);
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

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstName = $_POST["first_name"];
    $lastName = $_POST['last_name'];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if (!$firstName) {
        $errors['firstName'] = 'First name is required !';

        //to  check username length
    } else if (strlen($firstName) < 4 || strlen($firstName) > 16) {

        $errors['firstName'] = 'First name must be in between 4 and 16 characters !';
    }

    if (!$lastName) {
        $errors['lastName'] = 'Last name is required !';

        //to  check username length
    } else if (strlen($lastName) < 4 || strlen($lastName) > 16) {

        $errors['lastName'] = 'Last name must be in between 4 and 16 characters !';
    }

    if (!$email) {
        $errors['email'] = 'Email is required !';

        // to check email format
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Must be valid email address !';
    }

    if (!$message) {
        $errors['message'] = 'Message is required !';
    }

    $_SESSION['contact_data'] = [
        'firstName' => $_POST['first_name'],
        'lastName' => $_POST['last_name'],
        'email' => $_POST['email'],
        'message' => $_POST['message'],

    ];
    if (!empty($errors)) {
        $_SESSION['contact_errors'] = $errors;

    } else {
        $sqlQuery = 'INSERT INTO contact(userId, first_name, last_name, email, message) VALUES(:userId, :first_name, :last_name, :email, :message)';
        $insertContact = $db->prepare($sqlQuery);
        $insertContact->execute([
            'userId' => $_SESSION['loggedUser']['id'],
            'first_name' => $_SESSION['contact_data']['firstName'],
            'last_name' => $_SESSION['contact_data']['lastName'],
            'email' => $_SESSION['contact_data']['email'],
            'message' => $_SESSION['contact_data']['message'],
        ]);

        echo 'your message already sended';
    }

    header('location: index.php');
    exit;

}
$postData = [];
$postErrors = [];
if (array_key_exists('contact_errors', $_SESSION) && array_key_exists('contact_data', $_SESSION)) {
    $postData = $_SESSION['contact_data'];
    $postErrors = $_SESSION['contact_errors'];
    unset($_SESSION['contact_errors'], $_SESSION['contact_data']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My Blog</title>
</head>

<body>

    <?php include_once 'header.php';?>


    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <img src="./avator/photo1.jpg" class="card-img-top" alt="...">
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
                        <?php foreach ($posts as $post) {?>
                        <div class="accordion-item">
                            <img src=" <?php echo $post['image']; ?>" alt="" class="post-image">
                            <h2 class="accordion-header" id="headingOne">
                                <strong>Title: </strong>
                                <a href="post.php?id=<?php echo $post['id']; ?>">
                                    <?php echo $post['title']; ?>
                                </a>

                                <p><i>subtitle: </i> <?php echo $post['subtitle']; ?></p>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <?php echo $post['content']; ?>
                                    <p><strong>Author: </strong><?php echo $post['author']; ?></p>
                                    <p><strong>Post At: </strong> <?php echo $post['date']; ?></p>

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
                    <form action="" method="post">
                        <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                            <?php foreach ($postErrors as $error) {
    echo $error . '<br> !';
}?>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Frsit Name</label>
                            <input type="text"
                                class="form-control  <?php echo isset($errors['firstName']) ? 'is-invalid' : '' ?>"
                                id="exampleFormControlInput1" placeholder="First name" name="first_name"
                                value="<?php echo $postData['firstName'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                            <input type="text"
                                class="form-control <?php echo isset($errors['lastName']) ? 'is-invalid' : '' ?>"
                                id="exampleFormControlInput1" placeholder="Last name" name="last_name"
                                value="<?php echo $postData['lastName'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email </label>
                            <input type="email"
                                class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>"
                                id="exampleFormControlInput1" placeholder="name@example.com" name="email"
                                value="<?php echo $postData['email'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>"
                                id="exampleFormControlTextarea1" rows="3" name="message"
                                value="<?php echo $postData['message'] ?? '' ?>"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Send</button>
                    </form>

                </div>
            </div>
        </div>

    </div>



    <?php include_once 'footer.php';?>

</body>

</html>