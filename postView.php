<?php require_once "./includes/config.php";

if (!isset($_GET["id"])) {
    header("location: ./index.php");
    exit();
}

$row = PostRepository::getPostById($_GET["id"]);
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


<section id="layout">
    <header>
        <a href="index.php"><h3>Blog</h3></a>
        <h1><?php echo $title; ?></h1>
        <p>Publikováno <?php echo $date; ?> v <a href="#"><?php echo $category_category_id; ?></a></p>
        <p><i class="fas fa-tags"></i> <?php
            foreach (TagRepository::getTagByPostId($post_id) as $tagId) {
                $tag = TagRepository::getTagById($tagId["tag_id"]);
                $tagTitle = $tag["title"];
                echo "<a href='#'>$tagTitle</a> ";
            }
            ?></p>
    </header>
    <article class="content">
        <?php echo $Parsedown->text($content);; ?>
    </article>
</section>


<?php require_once "./template/footer.php" ?>
