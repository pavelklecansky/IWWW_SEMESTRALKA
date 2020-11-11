<?php


class CommentRepository
{

    static function getCategoryByPostId($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM comment WHERE post_post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

}