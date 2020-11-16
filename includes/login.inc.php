<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    require_once "./config.php";
    if (ValidationUtils::isEmpty($username) || ValidationUtils::isEmpty($password)) {
        header("location: ../admin/login.php?error=emptyinput");
        exit();
    }
    if ($user->login($username,$password)) {
        header("location: ../admin/index.php");
        exit();
    }else{
        header("location: ../admin/login.php?error=wronglogin");
        exit();
    }

} else {
    header("location: ../admin/login.php");
    exit();
}