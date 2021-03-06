<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Blog</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./site.webmanifest" rel="manifest" />

</head>

<body>
    <!-- Navigation-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">


                <a class="navbar-brand" href="index.php?index.php">
                    Rachel Duret
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                href="index.php?action=<?php echo isset($_SESSION['admin']) && $_SESSION['admin']['id'] === '3'? 'adminIndex': 'posts' ?>">Posts</a>
                        </li>
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']['id'] === '3') {?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                href="index.php?action=createPost">Creat Post</a></li>

                        <?php }?>

                        <?php if (!isset($_SESSION['loggedUser']) ) {?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                href="index.php?action=login">Login</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                href="index.php?action=register">Register</a>
                        </li>
                        <?php }?>
                        <?php if (isset($_SESSION['admin']) || isset($_SESSION['loggedUser'])) {?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                href="index.php?action=logout">Logout</a>
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Header-->
    <header class="masthead">
    </header>
    <!-- Main Content-->


    <?=$content?>


    <!-- Footer-->
    <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="https://twitter.com/home">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/feed/">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/rachel-duret">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">
                        <a href="index.php?action=adminLogin">Admin </a>
                    </div>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; My Blog 2022</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
