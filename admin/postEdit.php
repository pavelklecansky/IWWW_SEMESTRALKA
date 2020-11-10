<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    $published = $published == "on" ? 1 : 0;

    PostRepository::updatePost($_GET["id"], $title, $content, $date, $published);
    header("location: ./index.php");
    exit();
}
$row = PostRepository::getPostById($_GET["id"]);
if (!isset($row)) {
    header("location: ./users.php");
    exit();
}
extract($row);

?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./postEdit.php?id=<?php echo $_GET["id"]; ?>" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat článek</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required
                       value="<?php echo $title; ?>"/>
                <label for="date">Datum</label>
                <input type="date" id="date" name="date" required/>
                <label for="content">Obsah</label>
                <textarea class="form-control" rows="3" id="content" name="content"></textarea>

                <label for="published">Publikovat
                    <?php
                    if ($published) {
                        echo ' <input type="checkbox" id="published" name="published" placeholder="Publikovat" checked/>';
                    } else {
                        echo ' <input type="checkbox" id="published" name="published" placeholder="Publikovat"/>';
                    }
                    ?>

                </label>

                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit článek"/>
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
    simplemde.value(`<?php echo $content; ?>`);
    document.querySelector("#date").valueAsDate = new Date("<?php echo $date; ?>");

</script>

<?php require_once "./template/footer.php" ?>

