<?php
session_start();
include('config.php');

$sqlQuery = 'SELECT * FROM posts ORDER BY date DESC';
// send one request
$postsStatement = $db->prepare($sqlQuery);
$postsStatement->execute();
$posts = $postsStatement->fetchAll();






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
    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="accordion" id="accordionExample">
            <?php foreach($posts as $post ) { ?>
            <div class="accordion-item " id="blogs-container">
                <img src=" <?php echo $post['image']; ?>" alt="" id="image">
                <h2 class="accordion-header" id="headingOne">
                    <strong>Title: </strong>
                    <a href="post.php?id=<?php echo $post['id']; ?>">
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

            <?php
                        }
                        ?>
        </div>
    </div>

    <?php include_once('footer.php'); ?>

</body>

</html>