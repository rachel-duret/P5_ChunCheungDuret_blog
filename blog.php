<?php
session_start();
include('config.php');


$id = $_GET['id']?? null;
$loggedUser = $_SESSION['loggedUser']?? '';


$sqlQuery = 'SELECT * FROM posts Where id= :id ';
// send one request
$postStatement = $db->prepare($sqlQuery);
$postStatement->execute( ['id'=>$id]);
$post = $postStatement->fetch(PDO::FETCH_ASSOC);





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
        <div class="accordion" id="accordionExample">


            <div class="accordion-item " id="blogs-container">
                <img src=" <?php echo $post['image']; ?>" alt="">
                <h2 class="accordion-header" id="headingOne">
                    <strong>Title: </strong>
                    <a href="blog.php?id=<?php echo $post['id']; ?>">
                        <?php echo $post['title']; ?>

                    </a>

                    <h6><i>subtitle: </i> <?php echo  $post['subtitle'];?></h6>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <?php echo $post['content'];?>
                        <p><strong>Author: </strong><?php echo $post['author'];?></p>
                        <p><strong>Post At: </strong> <?php echo $post['date'];?></p>

                    </div>
                </div>
            </div>


            <?php if($loggedUser){ ?>
            <div class="d-grid gap-2 d-md-block">
                <a href="update.php?id=<?php echo $id ?>" class="btn btn-primary" type="button">Update</a>

                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>

            </div>
            <?php } ?>
        </div>
    </div>



    <?php include_once('footer.php'); ?>

</body>

</html>