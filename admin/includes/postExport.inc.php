<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
if (!$user->isLogged()) {
    header("location: ../login.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $row = PostRepository::getPostById($id);
    $title = $row["title"];
    $description = $row["description"];
    $content = $row["content"];
    $date = $row["date"];
    $published = $row["published"];
    $category = (CategoryRepository::getCategoryTitleById($row["category_category_id"]))["title"];
    $tags = [];
    foreach (TagRepository::getTagByPostId($id) as $tagId) {
        $tag = TagRepository::getTagById($tagId["tag_id"]);
        $tagTitle = $tag["title"];
        array_push($tags, $tagTitle);
    }

    $post = array("title" => $title, "description" => $description, "content" => $content, "date" => $date,
        "published" => $published, "category" => $category, "tags" => $tags);


    $json = json_encode($post);
    header("Content-disposition: attachment; filename=" . $title . "Export.json");
    header("Content-type: application/json");

    echo($json);
}