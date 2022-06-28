<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <?php foreach ($post as $post) {?>
        <div class="col-md-10 col-lg-8 col-xl-7">
            <a href="index.php?action=post&amp;id=<?php echo $post->id(); ?>">

                <h2 class="post-title">
                    <strong>Title: </strong>
                    <?php echo $post->title(); ?>
                </h2>
                <h3 class="post-subtitle"><i>subtitle: </i> <?php echo $post->subtitle(); ?></h3>
                <img src=" <?php echo $post->image(); ?>" class="img-thumbnail" alt="post iamge">
            </a>
            <p class="post-meta"><strong>Author: </strong><?php echo $post->author(); ?></p>
            <p class="post-meta"><strong>Post At: </strong> <?php echo $post->date(); ?></p>

        </div>
        <hr class="my-4" />

        <?php
}
?>
    </div>
</div>
