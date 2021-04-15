<?php

session_start();
include_once "dbh.inc.php";

if($_POST["cta"] === "Log Out"){
    session_unset();
    session_destroy();
    header("location: ../index.php");
}

if (isset($_POST["cta"]) && $_POST["cta"] === "Sign Up"){
    header("location: ../index.php?cta=signup");
}
if (isset($_POST["cta"]) && $_POST["cta"] === "Login"){
    header("location: ../index.php?cta=login");
}


if(isset($_POST["signup"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $confirm_password = $_POST["confirm_password"];
    $password = $_POST["password"];

//Error handler
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION["error"][] = "<p class='text-danger'>Incorrect Email Format</p>";
    }
    if($password !== $confirm_password){
        $_SESSION["error"][] = "<p class='text-danger'>Password Doesn't Match</p>";
    }

    if(strlen($password) < 8){
        $_SESSION["error"][] = "<p class='text-danger'>Password Should Not Be Less Than 8 Characters</p>";
    }

    if(!empty($_SESSION["error"])){
        header("location: ../index.php?cta=signup");
        exit();
    }


    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    $result = $conn->query("INSERT INTO users(userEmail,userPassword,userFirstName,userLastName) VALUES('$email','$password','$firstname','$lastname');");

    header("location: ../index.php?cta=login&signup=success");
}

if (isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $conn->query("SELECT userId,userEmail,userPassword,userfirstName FROM users WHERE userEmail = '$email'; ");
    if($result->num_rows){

        while($row = $result->fetch_object()){
            if(password_verify($password,$row->userPassword)){
                session_start();
                $_SESSION["name"] = $row->userfirstName;
                $_SESSION["id"] = $row->userId;
                header("location: ../profile.php");
            }else{
                header("location: ../index.php?cta=login&login=fail");
            }
        }
    }else{
        header("location: ../index.php?cta=login&login=fail");
    }


}

mysqli_close($conn);