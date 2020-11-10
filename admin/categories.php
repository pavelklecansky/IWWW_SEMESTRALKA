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
        $dataTable = new DataTable(CategoryRepository::getAll());
        $dataTable->addColumn("category_id", "Id");
        $dataTable->addColumn("title", "Titulek");
        $dataTable->addColumn("slug", "Popis");
        $dataTable->render("category");
        ?>
        <a href="./categoryAdd.php"><button class="pure-button pure-button-primary">Přidat kategorii</button></a>
    </article>
</section>


<?php require_once "./template/footer.php" ?>
