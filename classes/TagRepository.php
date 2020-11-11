<?php


class TagRepository
{
    static function getAll(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM tag");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getTagById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM tag WHERE tag_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function getTagIdByTitle($title)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT tag_id FROM tag WHERE title=:title");
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function getTagByPostId($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT tag_id FROM post_tag WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function deleteTagById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM tag WHERE tag_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    static function deleteAllTagByPostID($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM post_tag WHERE post_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }


    static function tagExists($title)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM tag WHERE title=:title");
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    static function insertTag($title, $slug)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO tag(title, slug) VALUE (:title,:slug)");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":slug", $slug);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    static function updateTag($id, $title, $slug)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE tag SET title=:title,slug=:slug WHERE tag_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":slug", $slug);
        $stmt->execute();
    }

    static function addTagToPost($post_id, $tag_id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO post_tag(post_id, tag_id) VALUE (:post_id,:tag_id)");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->bindParam(":tag_id", $tag_id);
        $stmt->execute();
    }
}