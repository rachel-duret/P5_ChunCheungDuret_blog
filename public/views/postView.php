<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">

            <div class="col-md-10 col-lg-8 col-xl-7">

                <h2 class="accordion-header" id="headingOne">
                    <strong>Title: </strong>

                    <?php echo $post->title(); ?>
                </h2>
                <h3><i>subtitle: </i> <?php echo $post->subtitle(); ?></h3>
                <img src=" <?php echo $post->image(); ?>" alt="" class="img-thumbnail">
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <?php echo $post->content(); ?>
                        <p><strong>Author: </strong><?php echo $post->author(); ?> - <strong>Post At: </strong>
                            <?php echo $post->date(); ?></p>


                    </div>
                </div>

            </div>

        </div>
        <!-- Divider-->
        <hr class="my-4" />
        <!--Comments -->
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <?php foreach ($comments as $comment) {?>
            <div class="accordion-body">
                <!--Comments body-->
                <?= $comment->comment() ?>

                <p class="post-meta">
                    Comment by:<strong> <?= $comment->username() ?></strong>
                    - At: <strong><?= $comment->date() ?></strong><?php ?></p>
            </div>

            <hr class="my-4" />
            <?php } ?>


            <?php if (isset($_SESSION['loggedUser']) || isset($_SESSION['admin'])) {?>
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
            <?php }?>
        </div>
    </div>
</article>