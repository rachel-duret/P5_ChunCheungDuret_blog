<div class="container px-4 px-lg-5">
    <div class=="row gx-4 gx-lg-5 justify-content-center">

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
            <div class="col-md-10 col-lg-8 col-xl-7">
                <img src=" <?php echo $post->image() ?>" alt="" class="img-thumbnail">
            </div>
            <div class="mb-3">
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

                <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>"
                    id="exampleFormControlTextarea1" rows="3" name="content"
                    placeholder="Content"> <?php echo $postData['content'] ?? $post->content() ?? '' ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="postImage" value="<?php echo $post->image() ?>">


            <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
        </form>

    </div>


</div>
