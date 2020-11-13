<h2>Komentáře</h2>
<section class="comments" id="commentsLink">
    <?php foreach (CommentRepository::getCommentsByPostId($post_id) as $comment): ?>
        <article class="comment">
            <?php
            if ($user->isLogged()) {
                echo "<a href='./includes/commentDelete.inc.php?id=" . $comment["comment_id"] . "'><h4 class='comment-delete'>Odstranit komentář</h4></a>";
            }
            ?>
            <p><span class="author"><?php echo htmlspecialchars($comment["author"]); ?></span> <span
                        class="date"><?php echo htmlspecialchars($comment["created_at"]); ?></span></p>
            <p><?php echo htmlspecialchars($comment["content"]); ?></p>

        </article>
    <?php endforeach; ?>
</section>
<form action="./includes/commentAdd.inc.php" method="post" class="commentsForm pure-form pure-form-stacked">
    <input type="hidden" name="id" value="<?php echo $post_id; ?>">
    <label for="name">Jméno</label>
    <input type="text" id="name" name="name" placeholder="Jméno"/>
    <label for="content">Obsah</label>
    <textarea rows="5" id="content" name="content" placeholder="Sem napiště váš komentář"></textarea>
    <button type="submit" class="pure-button pure-button-primary" name="submit">Přidej komentář</button>
</form>
