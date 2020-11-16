<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "emptyinput") {
        $errorMessage = "Prázdný vstup";
    }
}
if (isset($_POST['submit'])) {
    extract($_POST);
    $categoryId = $_GET["id"];
    if (ValidationUtils::isEmpty($title) || ValidationUtils::isEmpty($slug)) {
        header("location: ./categoryEdit.php?id=$categoryId&error=emptyinput");
        exit();
    }
    CategoryRepository::updateCategory($_GET["id"], $title, $slug);
    header("location: ./categories.php");
    exit();
}

$row = CategoryRepository::getCategoryById($_GET["id"]);
if (!isset($row)) {
    header("location: ./categories.php");
    exit();
}
extract($row);

?>



<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./categoryEdit.php?id=<?php echo $_GET["id"]; ?>" method="post"
              class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Upravit kategorii</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required
                       value="<?php echo $title; ?>"/>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug" required value="<?php echo $slug; ?>"/>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit kategorii"/>
                <?php
                if ($errorMessage != "") {
                    echo '<div class="bar error">';
                    echo $errorMessage;
                    echo '</div>';
                }
                ?>
            </fieldset>
        </form>
    </article>
</section>

<?php require_once "./template/footer.php" ?>

