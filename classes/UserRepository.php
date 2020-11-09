<?php


class UserRepository
{
    static function getAll(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getUserByUsername($username)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function getUserByEmail($email)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE email=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function getUserByEmailOrUsername($email_username)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=:username OR email=:email");
        $stmt->bindParam(":username", $email_username);
        $stmt->bindParam(":email", $email_username);
        $stmt->execute();
        return $stmt->fetch();
    }
}