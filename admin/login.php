<?php require_once "../includes/config.php";

if ($user->isLogged()) {
    header("location: ./index.php");
    exit();
}
?>

<?php require_once "./template/header.php"?>


<form method="post" action="../includes/login.inc.php" class="pure-form">
    <p>
        Uživatelské jméno/Email:
        <input type="text" name="username" placeholder="Uživatelské jméno/Email"/>
    </p>
    <p>
        Heslo:
        <input type="password" name="password" placeholder="Heslo"/>
    </p>
    <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přihlasit"/>
</form>


<?php require_once "./template/footer.php"?>