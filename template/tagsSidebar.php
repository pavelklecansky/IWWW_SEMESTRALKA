<?php require_once "./template/header.php" ?>

<section>
    <h3>Tagy</h3>
    <ul>
        <?php foreach (TagRepository::getAll() as $tag): extract($tag) ?>
            <a href='tags.php?title=<?php echo $title; ?>'>
                <li><?php echo $title; ?></li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>

