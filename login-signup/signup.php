<section class="container my-5">
    <h2 class="my-2 text-dark">Register Now</h2>
    <form action="includes/process.inc.php" method="post" class="d-block">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" name="firstname" class="form-control" placeholder="First Name" aria-label="first name" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" name="lastname" class="form-control" placeholder="Last Name" aria-label="last name" aria-describedby="basic-addon1">
        </div>

        <label for="basic-url" class="form-label">Your Email Address</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Example@abc.com</span>
            <input type="text" name="email" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">#</span>
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">#</span>
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" aria-label="confirm password" aria-describedby="basic-addon1">
        </div>
        <input type="hidden" name="signup">
        <input type="submit" value="Sign Up" class="btn btn-primary">
    </form>

    <div class="my-3">
        <?php
        if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
            foreach ($_SESSION["error"] as $error){
                echo $error;
                session_unset();

            }
        }
        ?>
    </div>
</section>