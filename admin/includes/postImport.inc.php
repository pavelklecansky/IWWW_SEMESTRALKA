<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
if (!$user->isLogged()) {
    header("location: ../login.php");
    exit();
}
$file = $_FILES["jsonImport"]["tmp_name"];
$string = file_get_contents($file);
$json = json_decode($string, true);
if ($json) {
    extract($json);
    if (!CategoryRepository::categoryExists($category)) {
        $categoryId = CategoryRepository::insertCategory($category, strtolower($category));
    } else {
        $categoryId = (CategoryRepository::getCategoryIdByTitle($category))["category_id"];
    }
    $postId = PostRepository::insertPost($title, $content, $date, $published, $_SESSION["userId"], $categoryId, $description);
    foreach ($tags as $tag) {
        if (!TagRepository::tagExists($tag)) {
            $tagId = TagRepository::insertTag($tag, strtolower($tag));
        } else {
            $tagId = (TagRepository::getTagIdByTitle($tag))["tag_id"];
        }
        TagRepository::addTagToPost($postId, $tagId);
    }
    header("location: ../index.php");
    exit();
}
header("location: ../index.php?error=badjson");
exit();

