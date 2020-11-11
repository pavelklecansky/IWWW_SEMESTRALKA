<?php require_once "./template/header.php" ?>

<section>
    <h3>Kategorie</h3>
    <ul>
        <?php foreach (CategoryRepository::getAll() as $category): extract($category) ?>
            <a href='categories.php?title=<?php echo $title; ?>'>
                <li><?php echo $title; ?></li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>

