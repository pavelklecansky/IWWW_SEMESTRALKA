<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error = "badjson") {
        $errorMessage = "Json je poškozen nebo je vložen ve špatném formátu.";
    }
}


?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <?php
        $dataTable = new DataTable(PostRepository::getAllForAdminIndex());
        $dataTable->AddView();
        $dataTable->AddExport();
        $dataTable->addColumn("post_id", "Id");
        $dataTable->addColumn("title", "Titulek");
        $dataTable->addColumn("date", "Datum");
        $dataTable->addColumn("username", "Tvůrce");
        $dataTable->addColumn("published", "Publikováno");
        $dataTable->addColumn("categoriiTitle", "Kategorie");
        $dataTable->render("post");
        ?>
        <a href="./postAdd.php">
            <button class="pure-button pure-button-primary">Přidat článek</button>
        </a>
        <form action="./includes/postImport.inc.php" method="post" enctype="multipart/form-data">
            <input type="file" name="jsonImport" id="jsonImport" accept=".json">
            <button class="pure-button pure-button-primary" id="OpenJsonImport">Import článek</button>
        </form>
        <?php
        if ($errorMessage != "") {
            echo '<div class="bar error">';
            echo $errorMessage;
            echo '</div>';
        }
        ?>
    </article>
</section>

<?php require_once "./template/footer.php" ?>
