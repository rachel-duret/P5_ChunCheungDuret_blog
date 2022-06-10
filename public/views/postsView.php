<div class="container-fluid">
    <div class="accordion" id="accordionExample">
        <?php foreach ($post as $post) {?>
        <div class="accordion-item " id="blogs-container">
            <img src=" <?php echo $post->image(); ?>" alt="" id="image">
            <h2 class="accordion-header" id="headingOne">
                <strong>Title: </strong>
                <a href="index.php?action=post&amp;id=<?php echo $post->id(); ?>">
                    <?php echo $post->title(); ?>

                </a>

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

        <?php
}
?>
    </div>
</div>