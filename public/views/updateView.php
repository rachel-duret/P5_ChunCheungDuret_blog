<div class="container-fluid">
    <div class="col-sm-8">

        <form action="index.php?action=updatePost&amp;id=<?=$post->id()?>" method="post" enctype="multipart/form-data">
            <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        foreach ($postError as $error) {
            echo $error . '<br>';
        }

    }
}?>

            </div>
            <div class="mb-3">
                <img src=" <?php echo $post->image() ?>" alt="" class="post-image">

                <label for="exampleFormControlInput1" class="form-label">Image</label>
                <input type="file" class="form-control " id="exampleFormControlInput1" placeholder="Title" name="image"
                    value="<?php echo $postData['image'] ?? $post->image() ?? '' ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Title" name="title"
                    value="<?php echo $postData['title'] ?? $post->title() ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subtitle</label>
                <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Subtitle"
                    name="subtitle" value="<?php echo $postData['subtitle'] ?? $post->subtitle() ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <textarea type="text" class="form-control " id="exampleFormControlInput1"
                    placeholder="Write somthing here ..." cols="30" rows="10" name="content">
                        <?php echo $postData['content'] ?? $post->content() ?? '' ?>
                    </textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="postImage" value="<?php echo $post->image() ?>">


            <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
        </form>

    </div>


</div>