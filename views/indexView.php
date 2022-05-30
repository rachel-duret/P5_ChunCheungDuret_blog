<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img src="./avator/photo1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rachel Duret</h5>
                        <p class="card-text">
                            Full-stack web developer: PHP - Javascript - ReactJS - Node.JS
                        </p>
                        <a href="#" class="btn btn-primary">Watch my CV</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary">Left</button>
                    <button type="button" class="btn btn-primary">Middle</button>
                    <button type="button" class="btn btn-primary">Right</button>
                </div>
            </div>
            <div class="col-sm-8">
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