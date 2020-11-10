<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

if (!$user->isAdmin()) {
    header("location: ./index.php");
    exit();
}
$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error = "usernameExists") {
        $errorMessage = "Uživatelské jméno už používá jiný uživatel";
    }
    if ($error = "emailExists") {
        $errorMessage = "Email už používá jiný uživatel";
    }
}

if (isset($_POST['submit'])) {
    extract($_POST);

    if (UserRepository::usernameExists($username)) {
        header("location: ./userAdd.php?error=usernameExists");
        exit();
    }

    if (UserRepository::emailExists($email)) {
        header("location: ./userAdd.php?error=emailExists");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    UserRepository::insertUser($username, $firstName, $lastName, $email, $hashedPassword, $role);
    header("location: ./users.php");
    exit();
}
?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./userAdd.php" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Přidání uživatele</legend>
                <label for="username">Uživatelský jméno</label>
                <input type="text" id="username" name="username" placeholder="Uživatelský jméno" required/>
                <label for="firstName">Jméno</label>
                <input type="text" id="firstName" name="firstName" placeholder="Jméno" required/>
                <label for="lastName">Přijmení</label>
                <input type="text" id="lastName" name="lastName" placeholder="Přijmení" required/>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required/>
                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" placeholder="Heslo" required/>
                <label for="role">Role</label>
                <select id="role" name="role">
                    <?php
                    foreach (RoleRepository::getAll() as $role) {
                        $id = $role["role_id"];
                        $name = $role["name"];
                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Přidej uživatele"/>

                <?php
                if ($errorMessage != "") {
                    echo '<div class="bar error">';
                    echo $errorMessage;
                    echo '</div>';
                }
                ?>


            </fieldset>
        </form>

    </article>
</section>


<?php require_once "./template/footer.php" ?>
