<?php
session_start();

require '../controllers/post.controller.php';
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$postData = new PostController();
$post = $postData->getOnePost($id);

$loggedUser = $_SESSION['loggedUser'] ?? '';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatePost = new PostController();
    $post = $updatePost->updateOnePost($_POST, $_FILES);
    header('location: update.php');
    exit;

}

require 'unset_session.php';

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
        <div class="col-sm-8">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                    <?php foreach ($postErrors as $error) {
    echo $error . '!<br> ';
}?>

                </div>
                <div class="mb-3">
                    <img src=" <?php echo $post['image'] ?>" alt="" class="post-image">

                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                    <input type="file" class="form-control " id="exampleFormControlInput1" placeholder="Title"
                        name="image" value="<?php echo $postData['image'] ?? $post['image'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Title"
                        name="title" value="<?php echo $postData['title'] ?? $post['title'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subtitle</label>
                    <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Subtitle"
                        name="subtitle" value="<?php echo $postData['subtitle'] ?? $post['subtitle'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Content</label>
                    <textarea type="text" class="form-control " id="exampleFormControlInput1"
                        placeholder="Write somthing here ..." cols="30" rows="10" name="content">
                        <?php echo $postData['content'] ?? $post['content'] ?? '' ?>
                    </textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="postImage" value="<?php echo $post['image'] ?>">


                <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
            </form>

        </div>

    </div>

    <?php include_once 'footer.php';?>

</body>

</html>