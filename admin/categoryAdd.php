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
    if (ValidationUtils::isEmpty($title)) {
        header("location: ./categoryAdd.php?id=$categoryId&error=emptyinput");
        exit();
    }
    CategoryRepository::insertCategory($title, Utils::slugify($title));
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
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej kategorii"/>
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

