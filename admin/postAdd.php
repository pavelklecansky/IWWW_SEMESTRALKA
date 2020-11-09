<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

?>
<?php require_once "./template/header.php" ?>


<div id="layout">
    <?php require_once "./template/navigation.php" ?>
    <div class="content">
        <form action="./userAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidat článek</legend>
                <label for="title">Titulek</label>
                <input type="text" id="title" name="title" placeholder="Titulek" required/>

                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej článek"/>
            </fieldset>
        </form>

    </div>
</div>


<?php require_once "./template/footer.php" ?>

