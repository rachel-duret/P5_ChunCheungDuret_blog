<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/views/app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My Blog</title>
</head>

<body>
    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Accuil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=posts">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=createPost">Create Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=register">Register</a>
            </li>
        </ul>
    </nav>
    <div class="container">

        <?=$content?>

    </div>


    <footer>
        <div class="card text-center">
            <div class="card-header">
                Footer
            </div>
            <div class="card-body">
                <h5 class="card-title">Footer treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Links</a>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </footer>


</body>

</html>