<div class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center"">
            <div class=" col-md-10 col-lg-8 col-xl-7">
            <form action="index.php?action=register" method="post">
                <div class="<?php echo $postErrors ? 'alert alert-danger' : '' ?>">
                    <?php if ($postErrors) {
    foreach ($postErrors as $postError) {
        foreach ($postError as $error) {
            echo $error . '<br>';
        }

    }
}?>

                </div>


                <div class="mb-3 row">
                    <label for="validationServer03" class="form-label">Username</label>
                    <input type="text"
                        class="form-control <?php echo isset($_SESSION['post_errors']['username']) ? 'is-invalid' : '' ?>"
                        id="validationServer03" aria-describedby="validationServer03Feedback" name="username"
                        minlength="4" value="<?php echo $postData['username'] ?? ''; ?>">
                </div>

                <div class="mb-3 row">
                    <label for="validationServer03" class="form-label">Email</label>
                    <input type="email"
                        class="form-control <?php echo isset($_SESSION['post_errors']['email']) ? 'is-invalid' : '' ?>"
                        id="validationServer03" aria-describedby="validationServer03Feedback" name="email"
                        value="<?php echo $postData['email'] ?? '' ?>">

                </div>

                <div class="mb-3 row">
                    <label for="validationServer03" class="form-label">Password</label>
                    <input type="password"
                        class="form-control <?php echo isset($_SESSION['post_errors']['password']) ? 'is-invalid' : '' ?>"
                        id="validationServer03" aria-describedby="validationServer03Feedback" name="password"
                        minlength="6" value="<?php echo $postData['password'] ?? ''; ?>">

                </div>

                <div class="mb-3 row">
                    <label for="validationServer03" class="form-label">Confirm Password</label>
                    <input type="password"
                        class="form-control <?php echo isset($_SESSION['post_errors']['confirmPassword']) ? 'is-invalid' : '' ?>"
                        id="validationServer03" aria-describedby="validationServer03Feedback" name="confirmPassword"
                        value="<?php echo $postData['confirmPassword'] ?? ''; ?>">

                </div>
                <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </form>
        </div>

    </div>
</div>

</div>
