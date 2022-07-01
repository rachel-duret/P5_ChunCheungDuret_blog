<div class="container px-4 px-lg-5">
    <div class=="row gx-4 gx-lg-5 justify-content-center">
        <form action="index.php?action=createPost" method="post" enctype="multipart/form-data">
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

                <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>"
                    id="exampleFormControlTextarea1" rows="5" name="content"
                    placeholder="Content"><?php echo $postData['message'] ?? '' ?></textarea>
            </div>


            <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
        </form>

    </div>

</div>
