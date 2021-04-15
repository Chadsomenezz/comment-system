<?php

session_start();
include_once "dbh.inc.php";


if(isset($_POST["add_new_comment"])){
    $user_id = $_SESSION["id"];
    $user_comment = $_POST["comment"];
    $result = $conn->query("INSERT INTO messages(users_id,message,created_at,updated_at) VALUES($user_id,'$user_comment',now(),now())");
    header("location: ../profile.php");
}

if(isset($_POST["replied"])){
    $user_id = $_SESSION["id"];
    $comment_id = $_POST["comment_field"];
    echo $comment_id;
    $user_comment = $_POST["reply"];
    $result = $conn->query("INSERT INTO comments(messages_id,users_id,comment,created_at,updated_at) VALUES($comment_id,'$user_id','$user_comment',now(),now())");
    header("location: ../profile.php");
}