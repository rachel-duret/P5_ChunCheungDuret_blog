<?php ob_start();?>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                    <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        foreach ($postError as $error) {
            echo $error . '<br>';
        }

    }
}?>

                </div>
                <form action="index.php?action=login" method="post">
                    <div class="mb-3 row">
                        <label for="validationServer03" class="form-label">Email</label>
                        <input type="email" class="form-control " id="validationServer03"
                            aria-describedby="validationServer03Feedback" name="email"
                            value="<?php echo $postData['email'] ?? '' ?>">
                    </div>
                    <div class="mb-3 row">
                        <label for="validationServer03" class="form-label">Password</label>
                        <input type="password" class="form-control" id="validationServer03"
                            aria-describedby="validationServer03Feedback" name="password">

                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </form>
            </div>
            <div class="col">
                2 of 2
            </div>
        </div>
    </div>

</div>
<?php $content = ob_get_clean();?>
<?php require 'template.php';