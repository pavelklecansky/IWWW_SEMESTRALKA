<?php
require_once "UserRepository.php";

class User
{

    public function isLogged()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            return true;
        }
    }

    public function isAdmin()
    {
        if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
            return true;
        }
    }


    public function login($username_email, $password)
    {
        $user = UserRepository::getUserByEmailOrUsername($username_email);
        if (!$user) {
            return false;
        }
        $userPassword = $user["password"];
        $check = $this->passwordVerify($password, $userPassword);
        if (!$check) {
            return false;
        } else {
            $_SESSION["loggedin"] = true;
            $_SESSION["userId"] = $user["user_id"];
            $_SESSION["admin"] = $user["role_id"] == 1;
            return true;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }

    private function passwordVerify($password, $databasePassword)
    {
        return password_verify($password, $databasePassword);
    }

}