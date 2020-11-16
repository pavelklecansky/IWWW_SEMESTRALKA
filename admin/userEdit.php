<?php require_once "../includes/config.php";

if (!$user->isLogged()) {
    header("location: ./login.php");
    exit();
}

if (!$user->isAdmin()) {
    header("location: ./index.php");
    exit();
}

if(!isset($_GET['id'])){
    header("location: ./users.php");
    exit();
}

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "usernameExists") {
        $errorMessage = "Uživatelské jméno už používá jiný uživatel";
    }
    if ($error == "emailExists") {
        $errorMessage = "Email už používá jiný uživatel";
    }
    if ($error == "emptyinput") {
        $errorMessage = "Prázdný vstup";
    }

    if ($error == "badEmailFormat") {
        $errorMessage = "Špatný formát emailu";
    }
}

if (isset($_POST['submit'])) {
    extract($_POST);
    $userId = $_GET["id"];
    $row = UserRepository::getUserById($userId);

    if (ValidationUtils::isEmpty($username) || ValidationUtils::isEmpty($firstName) ||
        ValidationUtils::isEmpty($lastName) || ValidationUtils::isEmpty($email) ||
        ValidationUtils::isEmpty($role) || ValidationUtils::isEmpty($password)) {
        header("location: ./userEdit.php?id=$userId&error=emptyinput");
        exit();
    }

    if (ValidationUtils::invalidEmail($email)){
        header("location: ./userAdd.php?id=$userId&?error=badEmailFormat");
        exit();
    }


    if (UserRepository::usernameExists($username) && $username != $row["username"]) {
        header("location: ./userEdit.php?id=$userId&?error=usernameExists");
        exit();
    }

    if (UserRepository::emailExists($email) && $email != $row["email"]) {
        header("location: ./userEdit.php?id=$userId&?error=emailExists");
        exit();
    }

    $hashedPassword = $row["password"];
    if ($password != $hashedPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    UserRepository::updateUser($_GET["id"], $username, $firstName, $lastName, $email, $role, $hashedPassword);
    header("location: ./users.php");
    exit();


}

$row = UserRepository::getUserById($_GET["id"]);
if (!isset($row)) {
    header("location: ./users.php");
    exit();
}
extract($row);


?>
<?php require_once "./template/header.php" ?>


<section id="layout">
    <?php require_once "./template/navigation.php" ?>
    <article class="content">
        <form action="./userEdit.php?id=<?php echo $_GET["id"]; ?>" method="post" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Upravit uživatele</legend>
                <label for="username">Uživatelský jméno</label>
                <input type="text" id="username" name="username" placeholder="Uživatelský jméno" required
                       value="<?php echo $username; ?>"/>
                <label for="firstName">Jméno</label>
                <input type="text" id="firstName" name="firstName" placeholder="Jméno" required
                       value="<?php echo $firstName; ?>"/>
                <label for="lastName">Přijmení</label>
                <input type="text" id="lastName" name="lastName" placeholder="Přijmení" required
                       value="<?php echo $lastName; ?>"/>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $email; ?>"/>
                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" placeholder="Heslo" required
                       value="<?php echo $password; ?>"/>
                <label for="role">Role</label>
                <select id="role" name="role">
                    <?php
                    foreach (RoleRepository::getAll() as $role) {
                        $id = $role["role_id"];
                        $name = $role["name"];
                        if ($id == $role_id) {
                            echo "<option value='$id' selected>$name</option>";
                        } else {
                            echo "<option value='$id'>$name</option>";
                        }


                    }
                    ?>
                </select>
                <input type="submit" name="submit" class="pure-button pure-button-primary" value="Upravit uživatele"/>

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
