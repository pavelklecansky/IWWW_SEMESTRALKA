<?php require_once "./includes/config.php";

if (!isset($_GET["id"])) {
    header("location: ./index.php");
    exit();
}

$row = PostRepository::getPostByIdForView($_GET["id"]);
if (!isset($row)) {
    header("location: ./index.php");
    exit();
}
extract($row);
$Parsedown = new Parsedown();

if ($published == 0 && !$user->isLogged()) {
    header("location: ./index.php");
    exit();
}
if ($published == 0) {
    echo "<h2 style='color: red'>Článek není publikován</h2>";
}

?>
<?php require_once "./template/header.php" ?>


<section id="layoutPost">
    <header>
        <a href="index.php"><h3>Blog</h3></a>
        <h1><?php echo $title; ?></h1>
        <p>Publikováno <?php echo $date; ?> v <a href="categories.php?title=<?php echo $categoryTitle; ?>"><?php echo $categoryTitle; ?></a></p>
        <p><i class="fas fa-tags"></i> <?php
            foreach (TagRepository::getTagByPostId($post_id) as $tagId) {
                $tag = TagRepository::getTagById($tagId["tag_id"]);
                $tagTitle = $tag["title"];
                echo "<a href='tags.php?title=$tagTitle'>$tagTitle</a> ";
            }
            ?></p>
    </header>
    <article class="content">
        <?php echo $Parsedown->text($content);; ?>
    </article>
    <?php require_once "./template/comments.php" ?>
</section>


<?php require_once "./template/footer.php" ?>
