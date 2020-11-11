<?php require_once "../includes/config.php";

if ($user->isLogged()) {
    header("location: ./index.php");
    exit();
}
?>

<?php require_once "./template/header.php" ?>

    <div class="login">
        <form method="post" action="../includes/login.inc.php" class="pure-form pure-form-stacked">

            <lable> Uživatelské jméno/Email:</lable>
            <input type="text" name="username" placeholder="Uživatelské jméno/Email"/>

            <lable> Heslo</lable>
            <input type="password" name="password" placeholder="Heslo"/>

            <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přihlasit"/>
        </form>
    </div>


<?php require_once "./template/footer.php" ?>