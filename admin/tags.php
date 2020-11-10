<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <?php
        $dataTable = new DataTable(TagRepository::getAll());
        $dataTable->addColumn("tag_id", "Id");
        $dataTable->addColumn("title", "Titulek");
        $dataTable->addColumn("slug", "Popis");
        $dataTable->render("tag");
        ?>
        <a href="./tagAdd.php"><button class="pure-button pure-button-primary">Přidat tag</button></a>
    </article>
</section>


<?php require_once "./template/footer.php" ?>
