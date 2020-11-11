<?php require_once "./includes/config.php";


?>
<?php require_once "./template/header.php" ?>


    <section id="layout">

        <h1>Můj Blog</h1>
        <article class="content">
            <?php foreach (PostRepository::getAllForIndex() as $post): extract($post) ?>
                <section class="post">
                    <header>
                        <a href="postView.php?id=<?php echo $post_id; ?>"><h2><?php echo $title; ?></h2></a>
                        <p>Publikováno <?php echo $date; ?> v <a href="#"><?php echo $categoriiTitle; ?></a></p>
                        <p><i class="fas fa-tags"></i> <?php
                            foreach (TagRepository::getTagByPostId($post_id) as $tagId) {
                                $tag = TagRepository::getTagById($tagId["tag_id"]);
                                $tagTitle = $tag["title"];
                                echo "<a href='#'>$tagTitle</a> ";
                            }
                            ?></p>
                    </header>
                    <div class="post_description">
                        <?php echo $description; ?>
                    </div>

                </section>


            <?php endforeach; ?>
        </article>
    </section>


<?php require_once "./template/footer.php" ?>