<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <div class="content">
        <?php
        $dataTable = new DataTable(PostRepository::getAllForIndex());
        $dataTable->AddView();
        $dataTable->addColumn("post_id", "Id");
        $dataTable->addColumn("title", "Titulek");
        $dataTable->addColumn("date", "Datum");
        $dataTable->addColumn("username", "Tvůrce");
        $dataTable->addColumn("published", "Publikováno");
        $dataTable->render("post");
        ?>
        <a href="./postAdd.php"><button class="pure-button pure-button-primary">Přidat článek</button></a>
    </div>
</section>


<?php require_once "./template/footer.php" ?>
