<?php
if (!isset($_GET["slug"])) {
    header("location: ./index.php");
    exit();
}

if (!TagRepository::tagExistsSlug($_GET["slug"])) {
    header("location: ./index.php");
    exit();
}
$tagAndTitle = (TagRepository::getTagIdAndTitleBySlug($_GET["slug"]));
$tagId = $tagAndTitle["tag_id"];
$tagTitle = $tagAndTitle["title"];
?>

<article class="content">
    <h3>Tag <?php echo $tagTitle; ?></h3>
    <?php foreach (PostRepository::getAllForIndexByTagId($tagId) as $post): extract($post) ?>
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
