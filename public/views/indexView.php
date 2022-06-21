<div class="container d-flex align-items-center flex-column">
    <!-- Masthead Avatar Image-->
    <img class="masthead-avatar mb-5" src="<?php echo $user->image() ?>" alt="..." />

    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <!-- Masthead Heading-->
        <h3 class="masthead-heading text-uppercase mb-0"><?php echo $user->username() ?></h3>
        <div class="divider-custom-line"><?php echo $user->profession() ?></div>
        <div class="divider-custom-line"><?php echo $user->skill() ?></div>

        <div class="divider-custom-line">
            <a href="index.php?action=cv" class="btn">Watch my CV</a>
        </div>
    </div>
    <!-- Masthead Subheading-->

</div>

<div class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon
                    as possible!
                </p>

                <form action="index.php" method="post">
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
                        <label for="exampleFormControlInput1" class="form-label">Frsit Name</label>
                        <input type="text"
                            class="form-control  <?php echo isset($errors['firstName']) ? 'is-invalid' : '' ?>"
                            id="exampleFormControlInput1" placeholder="First name" name="first_name"
                            value="<?php echo $postData['first_name'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                        <input type="text"
                            class="form-control <?php echo isset($errors['lastName']) ? 'is-invalid' : '' ?>"
                            id="exampleFormControlInput1" placeholder="Last name" name="last_name"
                            value="<?php echo $postData['last_name'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email </label>
                        <input type="email"
                            class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>"
                            id="exampleFormControlInput1" placeholder="name@example.com" name="email"
                            value="<?php echo $postData['email'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                        <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>"
                            id="exampleFormControlTextarea1" rows="3" name="message"
                            value="<?php echo $postData['message'] ?? '' ?>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Send</button>
                </form>
            </div>
        </div>


    </div>
</div>