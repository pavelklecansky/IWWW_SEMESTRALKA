<?php


class PostRepository
{
    static function getAllForIndex(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT post_id,title,date,username,IF(`published` = 1, 'Ano', 'Ne') AS published FROM post JOIN user u on u.user_id = post.post_author");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function deleteUserById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM post WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

}