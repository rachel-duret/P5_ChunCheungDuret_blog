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
            <!--validation comments-->
            <div class="d-grid gap-2 d-md-block" id="btn">
                <div class="d-flex justify-content-end mb-4">

                    <form action="index.php?action=validComment&amp;id=<?=$comment->id()?>" method="post">
                        <input type="hidden" name="post_id" value="<?=$post->id()?>">
                        <input type="hidden" name="id" value="<?=$comment->id()?>">
                        <?php if($comment->validation()==0){?>
                        <button class="btn btn-primary" type="submit">valid</button>
                        <?php } ?>

                    </form>

                    <form action="index.php?action=deleteComment&amp;id=<?=$comment->id()?>" method="post">
                        <input type="hidden" name="post_id" value="<?=$post->id()?>">
                        <input type="hidden" name="id" value="<?=$comment->id()?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>


            </div>


            <hr class="my-4" />
            <?php } ?>

        </div>
    </div>
</article>