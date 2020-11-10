<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

if (!$user->isAdmin()) {
    header("location: ./index.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <?php
        $dataTable = new DataTable(UserRepository::getAllWithNameRole());
        $dataTable->addColumn("user_id", "Id");
        $dataTable->addColumn("username", "Uživatelské jméno");
        $dataTable->addColumn("firstName", "Jméno");
        $dataTable->addColumn("lastName", "Přijmení");
        $dataTable->addColumn("email", "Email");
        $dataTable->addColumn("name", "Role");
        $dataTable->render("user");
        ?>
        <a href="./userAdd.php"><button class="pure-button pure-button-primary">Přidat uživatele</button></a>
    </article>
</section>


<?php require_once "./template/footer.php" ?>
