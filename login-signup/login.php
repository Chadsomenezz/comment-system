<section class="container my-5">
    <h2 class="my-2 text-dark">Login</h2>
    <form action="includes/process.inc.php" method="post" class="d-block">


        <label for="basic-url" class="form-label">Your Email Address</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Example@abc.com</span>
            <input type="text" name="email" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">#</span>
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1">
        </div>
        <?php if(isset($_GET["signup"]) && $_GET["signup"] === 'success'){
            echo "<p class='text-success'>Registered Successfully</p>";
        }

        if(isset($_GET["login"]) && $_GET["login"] === 'fail'){
            echo "<p class='text-danger'>Incorrect Email or Password</p>";
        }
        ?>
        <input type="hidden" name="login">
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
</section>