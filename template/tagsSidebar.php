<section>
    <h3>Tagy</h3>
    <ul>
        <?php foreach (TagRepository::getAll() as $tag): extract($tag) ?>
            <a href='index.php?page=tags&title=<?php echo $title; ?>'>
                <li><?php echo $title; ?></li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>

