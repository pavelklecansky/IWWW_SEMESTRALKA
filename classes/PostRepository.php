<?php


class PostRepository
{
    static function getAllForIndex(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT post_id,post.title,DATE_FORMAT(date, '%d.%m.%Y') as date,username,IF(`published` = 1, 'Ano', 'Ne') AS published, c.title AS categoriiTitle
FROM post JOIN user u on u.user_id = post.post_author JOIN category c on c.category_id = post.category_category_id");
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

    static function insertPost($title, $content, $date, $published, $post_author, $category)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO post(title,content,date,published,post_author,category_category_id) VALUE (:title,:content,DATE_ADD(:date, INTERVAL 2 HOUR),:published,:post_author,:category)");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":published", $published);
        $stmt->bindParam(":post_author", $post_author);
        $stmt->bindParam(":category", $category);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    static function updatePost($id, $title, $content, $date, $published, $category)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE post SET title=:title,content=:content,date=DATE_ADD(:date, INTERVAL 2 HOUR),published=:published, category_category_id=:category WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":published", $published);
        $stmt->bindParam(":category", $category);
        $stmt->execute();
    }

}