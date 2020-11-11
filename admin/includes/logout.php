<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($user->logout()) {
    header("location: " . $_SERVER["DOCUMENT_ROOT"] . "./index.php");
}