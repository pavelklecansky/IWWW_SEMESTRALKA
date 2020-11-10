<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
if (isset($_POST['submit'])) {
    extract($_POST);

    CategoryRepository::insertCategory($title, $slug);
    header("location: ./categories.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./categoryAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat kategorii</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required/>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug" required/>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej kategorii"/>
            </fieldset>
        </form>
    </article>
</section>

<?php require_once "./template/footer.php" ?>

