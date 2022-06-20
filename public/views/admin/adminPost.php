<!-- Page Header-->
<header class="masthead">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1></h1>
                    <h2 class="subheading"></h2>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">

            <div class="col-md-10 col-lg-8 col-xl-7">
                <img src=" <?php echo $post->image(); ?>" alt="" class="">
                <h2 class="accordion-header" id="headingOne">
                    <strong>Title: </strong>

                    <?php echo $post->title(); ?>


                    <h6><i>subtitle: </i> <?php echo $post->subtitle(); ?></h6>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <?php echo $post->content(); ?>
                        <p><strong>Author: </strong><?php echo $post->author(); ?></p>
                        <p><strong>Post At: </strong> <?php echo $post->date(); ?></p>

                    </div>
                </div>

            </div>


            <?php if ($_SESSION['loggedUser']['username'] === $post->author()) {?>
            <div class="d-grid gap-2 d-md-block" id="btn">
                <div class="d-flex justify-content-end mb-4">
                    <a href="index.php?action=updatePost&amp;id=<?=$post->id()?>" class="btn btn-primary "
                        type="button">Update</a>

                    <form action="index.php?action=deletePost&amp;id=<?=$post->id()?>" method="post">
                        <input type="hidden" name="id" value="<?=$post->id()?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>


            </div>
            <?php }?>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        <!--Comments -->
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="accordion-body">
                <!--Comments body-->


                <p class="post-meta">
                    Comment by:<strong>Lara </strong><?php ?>
                    Comment At:<i>2022-05-31 13:21:20</i><?php ?></p>
            </div>
            <div class="accordion-body">
                <!--Comments body-->
                Here is Comment body, I will write something here.

                <p class="post-meta">
                    Comment by:<strong>Lara </strong><?php ?>
                    Comment At:<i>2022-05-31 13:21:20</i><?php ?></p>
            </div>

            <form action="index.php?action=createComment" method="post">
                <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                    <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        foreach ($postError as $error) {
            echo $error . '<br>';
        }

    }
}?>

                </div>
                <div class="d-flex justify-content-end mb-4">
                    <input type="text" name="comment" value="<?php echo $postData['content'] ?? '' ?>"
                        class=" form-control" />
                    <input type="hidden" name="id" value="<?php echo $post->id() ?>" />
                    <button class="btn btn-primary " type="submit">Comment</button>
                </div>


            </form>
        </div>
    </div>
</article>