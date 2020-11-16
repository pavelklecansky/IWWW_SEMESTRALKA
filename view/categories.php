<?php
if (!isset($_GET["slug"])) {
    header("location: ./index.php");
    exit();
}

if (!CategoryRepository::categoryExistsSlug($_GET["slug"])) {
    header("location: ./index.php");
    exit();
}
$category = (CategoryRepository::getCategoryIdAndTitleBySlug($_GET["slug"]));
$categoryId = $category["category_id"];
$categoryTitle = $category["title"];
?>


<article class="content">
    <h3>Kategorie <?php echo $categoryTitle; ?></h3>
    <?php foreach (PostRepository::getAllForIndexByCategoryId($categoryId) as $post): extract($post) ?>
        <section class="post">
            <header>
                <a href="./postView.php?id=<?php echo $post_id; ?>"><h2><?php echo $title; ?></h2></a>
                <p>Publikováno <?php echo $date; ?> v <a
                            href="index.php?page=categories&slug=<?php echo $categoriiSlug; ?>"><?php echo $categoriiTitle; ?></a>
                </p>
                <p><i class="fas fa-tags"></i> <?php
                    foreach (TagRepository::getTagByPostId($post_id) as $tagId) {
                        $tag = TagRepository::getTagById($tagId["tag_id"]);
                        $tagTitle = $tag["title"];
                        $tagSlug = $tag["slug"];
                        echo "<a href='index.php?page=tags&slug=$tagSlug'>$tagTitle</a> ";
                    }
                    ?></p>
            </header>
            <div class="post_description">
                <?php echo $description; ?>
            </div>

        </section>


    <?php endforeach; ?>
</article>
