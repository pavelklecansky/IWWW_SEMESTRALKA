<section>
    <h3>Kategorie</h3>
    <ul>
        <?php foreach (CategoryRepository::getAll() as $category): extract($category) ?>
            <a href='index.php?page=categories&title=<?php echo $title; ?>'>
                <li><?php echo $title; ?></li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>

