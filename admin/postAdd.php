<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    $published = $published == "on" ? 1 : 0;
    $author = $_SESSION["userId"];

    PostRepository::insertPost($title, $content, $date, $published, $author);
    header("location: ./index.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./postAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat článek</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required />
                <label for="date">Datum</label>
                <input type="date" id="date" name="date" required/>
                <label for="content">Obsah</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
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

