<?php require_once "./config.php";
if (!$user->isLogged()) {
    header("location: ../login.php");
    exit();
}

if (isset($_GET["id"])) {
    CommentRepository::deleteCommentById($_GET["id"]);
    header("location: " . $_SERVER['HTTP_REFERER']."#commentsLink");
    exit();
}

header("location: ../index.php");
exit();