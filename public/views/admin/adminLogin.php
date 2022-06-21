<div class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>This is <strong> ADMIN </strong> login page make sure you have the right to acces to this page !
                </p>
                <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                    <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        foreach ($postError as $error) {
            echo $error . '<br>';
        }

    }
}?>

                </div>
                <form action="index.php?action=adminLogin" method="post">
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

        </div>
    </div>

</div>