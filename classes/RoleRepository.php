<?php


class RoleRepository
{
    static function getAll(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM role");
        $stmt->execute();
        return $stmt->fetchAll();
    }


}