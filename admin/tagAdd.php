<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    TagRepository::insertTag($title, $slug);
    header("location: ./tags.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./tagAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat tag</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required/>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug" required/>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej tag"/>
            </fieldset>
        </form>
    </article>
</section>

<?php require_once "./template/footer.php" ?>

