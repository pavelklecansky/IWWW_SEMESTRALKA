<?php


class PostRepository
{
    static function getAllForIndex(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT post_id,title,DATE_FORMAT(date, '%d.%m.%Y') as date,username,IF(`published` = 1, 'Ano', 'Ne') AS published FROM post JOIN user u on u.user_id = post.post_author");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getPostById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM post WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function deleteUserById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM post WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    static function insertPost($title, $content, $date, $published, $post_author)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO post(title,content,date,published,post_author) VALUE (:title,:content,DATE_ADD(:date, INTERVAL 2 HOUR),:published,:post_author)");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":published", $published);
        $stmt->bindParam(":post_author", $post_author);
        $stmt->execute();
    }

    static function updatePost($id, $title, $content, $date, $published)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE post SET title=:title,content=:content,date=DATE_ADD(:date, INTERVAL 2 HOUR),published=:published WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":published", $published);
        $stmt->execute();
    }

}