<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if (!$user->isLogged()) {
    header("location: ../login.php");
    exit();
}

if (isset($_GET["id"])) {
    TagRepository::deleteTagById($_GET["id"]);
    header("location: ../tags.php");
    exit();
}


