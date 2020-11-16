<section>
    <h3>Kategorie</h3>
    <ul>
        <?php foreach (CategoryRepository::getAll() as $category): extract($category) ?>
            <a href='index.php?page=categories&slug=<?php echo $slug; ?>'>
                <li><?php echo $title; ?></li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>

