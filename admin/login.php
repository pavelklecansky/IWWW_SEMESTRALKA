<?php require_once "../includes/config.php";

if ($user->isLogged()) {
    header("location: ./index.php");
    exit();
}
$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "emptyinput") {
        $errorMessage = "Prázdný vstup";
    }
}

?>

<?php require_once "./template/header.php" ?>

    <div class="login">
        <form method="post" action="../includes/login.inc.php" class="pure-form pure-form-stacked">

            <label for="username"> Uživatelské jméno/Email:</label>
            <input type="text" id="username" name="username" placeholder="Uživatelské jméno/Email" required/>

            <label for="password"> Heslo</label>
            <input type="password" id="username" name="password" placeholder="Heslo" required/>

            <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přihlasit" />
            <?php
            if ($errorMessage != "") {
                echo '<div class="bar error">';
                echo $errorMessage;
                echo '</div>';
            }
            ?>
        </form>
    </div>


<?php require_once "./template/footer.php" ?>