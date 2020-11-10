<?php


class CategoryRepository
{
    static function getAll(): array
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM category");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getCategoryById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM category WHERE category_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    static function deleteCategoryById($id)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("DELETE FROM category WHERE category_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    static function insertCategory($title, $slug)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("INSERT INTO category(title, slug) VALUE (:title,:slug)");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":slug", $slug);
        $stmt->execute();
    }

    static function updateCategory($id, $title, $slug)
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE category SET title=:title,slug=:slug WHERE category_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":slug", $slug);
        $stmt->execute();
    }
}