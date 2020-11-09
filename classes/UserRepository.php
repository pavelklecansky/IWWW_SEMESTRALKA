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

    static function getAllWithNameRole(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user JOIN role r on r.role_id = user.role_id;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getUserById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE user_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
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

    static function usernameExists($username)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    static function emailExists($email)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM user WHERE email=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    static function deleteUserById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM user WHERE user_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    static function insertUser($username, $firstName, $lastName, $email, $password, $role)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO user(username, firstName, lastName, email, password, role_id) VALUE (:username,:firstName,:lastName,:email,:password,:role_id)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":role_id", $role);
        $stmt->execute();
    }

    static function updateUser($id, $username, $firstName, $lastName, $email, $role, $password)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE user SET username=:username, firstName=:firstName, lastName=:lastName, email=:email, role_id=:role_id, password=:password WHERE user_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role_id", $role);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }
}