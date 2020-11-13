<?php


class CommentRepository
{

    static function getCommentsByPostId($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM comment WHERE post_post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function insertComment($id, $author, $content)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO comment(author, created_at, content, post_post_id) VALUES (:author,SYSDATE(),:content,:id)");
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    static function deleteCommentById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM comment WHERE comment_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

}