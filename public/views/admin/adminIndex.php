<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <?php foreach ($post as $post) {?>
        <div class="col-md-10 col-lg-8 col-xl-7">
            <a href="index.php?action=adminPost&amp;id=<?php echo $post->id(); ?>">
                <h2 class="post-title">
                    <strong>Title: </strong>
                    <?php echo $post->title(); ?>
                </h2>
                <h3 class="post-subtitle"><i>Subtitle: </i> <?php echo $post->subtitle(); ?></h3>
                <h3>Post_id: <?php echo $post->id(); ?></h3>
                <p> <?php echo $post->date(); ?></p>

            </a>


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
        <hr class="my-4" />

        <?php
}
?>
    </div>
</div>
