<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    CategoryRepository::updateCategory($_GET["id"], $title, $slug);
    header("location: ./categories.php");
    exit();
}

$row = CategoryRepository::getCategoryById($_GET["id"]);
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
        <form action="./categoryEdit.php?id=<?php echo $_GET["id"]; ?>" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Upravit kategorii</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required
                       value="<?php echo $title; ?>"/>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug" required value="<?php echo $slug; ?>"/>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit kategorii"/>
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

