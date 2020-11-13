<?php
if (isset($_POST["submit"])) {
    extract($_POST);
    require_once "./config.php";

    CommentRepository::insertComment($id, $name, $content);
    header("location: ../postView.php?id=" . $id."#commentsLink");
    exit();
} else {
    header("location: ../index.php");
    exit();
}