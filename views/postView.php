<?php ob_start();?>

<div class="container-fluid">
    <div class="accordion" id="accordionExample">


        <div class="accordion-item " id="blogs-container">
            <img src=" <?php echo $post['image']; ?>" alt="" class="post-image">
            <h2 class="accordion-header" id="headingOne">
                <strong>Title: </strong>
                <a href="post.php?id=<?php echo $post['id']; ?>">
                    <?php echo $post['title']; ?>

                </a>

                <h6><i>subtitle: </i> <?php echo $post['subtitle']; ?></h6>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <?php echo $post['content']; ?>
                    <p><strong>Author: </strong><?php echo $post['author']; ?></p>
                    <p><strong>Post At: </strong> <?php echo $post['date']; ?></p>

                </div>
            </div>
        </div>


        <?php if ($loggedUser) {?>
        <div class="d-grid gap-2 d-md-block" id="btn">
            <div class="btn">
                <a href="update.php?id=<?php echo $id ?>" class="btn btn-primary" type="button">Update</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>


        </div>
        <?php }?>

        <div class="d-grid gap-2 d-md-block" id="comment">
            <div>
                Comment
                <?php foreach ($comments as $comment) {?>
                <div><?php echo $comment['comment'] ?></div>
                <div>
                    <p><?php echo $comment['username'] ?></p>
                    <p><?php echo $comment['date'] ?></p>

                </div>
                <?php }?>
            </div>
            <form action="comment.php" method="post">

                <input type="text" name="comment" value="">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <button class="btn btn-primary" type="submit">Comment</button>

            </form>

        </div>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require 'template.php';