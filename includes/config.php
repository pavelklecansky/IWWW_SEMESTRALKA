<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/Parsedown.php";
function __autoload($class)
{
    require_once $_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class . '.php';
}

$root = $_SERVER["DOCUMENT_ROOT"];
ob_start();
session_start();


$conn = Connection::getPdoInstance();
$user = new User();