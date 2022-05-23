<?php ob_start();?>

<div class="container-fluid">
    <div class="col-sm-8">
        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                <?php foreach ($postErrors as $error) {
    echo $error . '!<br> ';
}?>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Image</label>
                <input type="file" class="form-control " id="exampleFormControlInput1" placeholder="Title" name="image"
                    value="<?php echo $postData['image'] ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Title" name="title"
                    value="<?php echo $postData['title'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subtitle</label>
                <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Subtitle"
                    name="subtitle" value="<?php echo $postData['subtitle'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <textarea type="text" class="form-control " id="exampleFormControlInput1"
                    placeholder="Write somthing here ..." cols="30" rows="10" name="content">
                        <?php echo $postData['content'] ?? '' ?>
                    </textarea>
            </div>


            <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
        </form>

    </div>

</div>

<?php $content = ob_get_clean();?>
<?php require 'template.php';