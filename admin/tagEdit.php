<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    TagRepository::updateTag($_GET["id"], $title, $slug);
    header("location: ./tags.php");
    exit();
}

$row = TagRepository::getTagById($_GET["id"]);
if (!isset($row)) {
    header("location: ./tags.php");
    exit();
}
extract($row);

?>



<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./tagEdit.php?id=<?php echo $_GET["id"]; ?>" method="post"
              class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Upravit tag</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required
                       value="<?php echo $title; ?>"/>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug" required value="<?php echo $slug; ?>"/>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit tag"/>
            </fieldset>
        </form>
    </article>
</section>

<?php require_once "./template/footer.php" ?>

