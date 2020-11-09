<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if (!$user->isLogged()) {
    header("location: ../login.php");
    exit();
}
if (!$user->isAdmin()) {
    header("location: ./index.php");
    exit();
}

if (isset($_GET["id"])){
    PostRepository::deleteUserById($_GET["id"]);
    header("location: ../index.php");
    exit();
}


