<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    $published = $published == "on" ? 1 : 0;
    $author = $_SESSION["userId"];

    $post_id = PostRepository::insertPost($title, $content, $date, $published, $author, $category, $description);
    foreach ($tagIds as $tag_id) {
        TagRepository::addTagToPost($post_id, $tag_id);
    }

    header("location: ./index.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="postAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat článek</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required/>
                <label for="date">Datum</label>
                <input type="date" id="date" name="date" required/>
                <label for="description">Popis</label>
                <textarea cols="50" id="description" name="description" placeholder="Popis"></textarea>
                <label for="content">Obsah</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                <label for="category">Kategorie</label>
                <select name="category" id="category">
                    <?php
                    foreach (CategoryRepository::getAll() as $category) {
                        extract($category);
                        echo "<option value='$category_id'>$title</option>";
                    }

                    ?>
                </select>

                <article class="tags">
                    <p>Tagy</p>
                    <fieldset>
                        <?php
                        foreach (TagRepository::getAll() as $tag) {
                            extract($tag);
                            echo "<label for='tagIds[]'>$title ";
                            echo "<input type='checkbox' id='$slug' name='tagIds[]' value='$tag_id' placeholder='$title'/></label>";
                        }
                        ?>
                    </fieldset>
                </article>

                <label for="published">Publikovat
                    <input type="checkbox" id="published" name="published" placeholder="Publikovat"/></label>

                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej článek"/>
            </fieldset>
        </form>

    </article>
</section>

<link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("content")
    });
    document.querySelector("#date").valueAsDate = new Date();

</script>

<?php require_once "./template/footer.php" ?>

