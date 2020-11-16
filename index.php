<?php require_once "./includes/config.php"; ?>
<?php require_once "./template/header.php" ?>
    <section id="layout">
        <div>
            <a href=""><h1>Můj Blog</h1></a>
            <?php
            if (isset($_GET["page"])) {
                $pathToFile = "./view/" . $_GET["page"] . ".php";
                if (file_exists($pathToFile)) {
                    include $pathToFile;
                } else {
                    include "./view/main.php";
                }
            } else {
                include "./view/main.php";
            }

            ?>
        </div>
        <div id="sidebars">
            <?php require_once "./template/categoriesSidebar.php" ?>
            <?php require_once "./template/tagsSidebar.php" ?>
        </div>

    </section>
<?php require_once "./template/footer.php" ?>