<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="accordion-body">
        <!--Comments body-->
        Here is Comment body, I will write something here.

        <p class="post-meta">
            Comment by:<strong>Lara </strong><?php ?>
            Comment At:<i>2022-05-31 13:21:20</i><?php ?></p>
    </div>
    <div class="accordion-body">
        <!--Comments body-->

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
        <input type="text" name="comment" value="<?php echo $postData['content'] ?? '' ?>" class=" form-control" />
        <input type="hidden" name="id" value="<?php echo $post->id() ?>" />
        <button class="btn btn-primary " type="submit">Comment</button>

    </form>
</div>