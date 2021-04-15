<?php session_start();

if (!isset($_SESSION["name"])){
    header("location: index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bootcamp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <form class="d-flex" action="includes/process.inc.php" method="post">
                <input type="submit" name="cta" value="Sign Up" class="btn btn-success mx-3">
                <?php
                    if(!isset($_SESSION["name"])){
                        echo "<input type='submit' name='cta' value='Login' class='btn btn-success mx-3'>";
                    }else{
                        echo "<input type='submit' name='cta' value='Log Out' class='btn btn-success mx-3'>";
                    }
                ?>

            </form>
        </div>
    </div>
</nav>

<section>
    <div class="container">
        <?php
            if(isset($_SESSION["name"])){
                echo '<h1 class="text-uppercase text-center">WELCOME ' . $_SESSION["name"] . " TO YOUR PROFILE</h1>";
            }
            ?>
    </div>

    <!--add new comment to post-->
    <div class="container text-center">
        <form action="includes/comments.inc.php" method="post">
            <h2>Add new Comment</h2>
            <textarea name="comment" id="" cols="70" rows="2"></textarea>
            <input type="hidden" name="add_new_comment">
            <input type="submit" class="btn btn-primary">
        </form>
    </div>

    <div class="container text-center my-3">

        <?php include "includes/dbh.inc.php"; ?>

        <section class="comments">

            <!--individual comment-->
                <?php
                    global $conn;
                    $result = $conn->query("SELECT * FROM messages INNER JOIN users ON users.userId = messages.users_id ORDER BY created_at DESC");
                    while($row = $result->fetch_object()){
                        echo "<div class='comment'>";
                            echo "<h2>$row->userFirstName $row->userLastName</h2>";
                            echo "<h3>$row->message</h3>";
                            echo "<h6>$row->created_at</h6>";

                            echo "
                                <form action='includes/comments.inc.php' method='post'>
                                <input type='text' name='reply'>
                                <input type='hidden' name='comment_field' value='$row->id'>
                                <input type='hidden' name='replied'>
                                <input type='submit' value='reply'>
                                </form>
                            ";

                        //individual reply
                        $comment_result = $conn->query("SELECT comments.messages_id, messages.id, userFirstName,userLastName, comments.created_at,comments.updated_at, comments.comment FROM comments INNER JOIN messages inner JOIN users on comments.messages_id = messages.id ORDER BY created_at DESC");

                        while($repliedComment = $comment_result->fetch_object()){
                            if($repliedComment->messages_id == $row->id){
                                echo "<div class='reply d-flex flex-column my-2'>";
                                    echo "<p class='text-primary'>$repliedComment->userFirstName $repliedComment->userLastName</p>";
                                    echo "<p>$repliedComment->comment</p>";
                                    echo "<small>$row->created_at</small>";
                                echo "<div>";
                            }
                        }

                    }

                ?>


        </section>
    </div>
</section>

</body>
</html>