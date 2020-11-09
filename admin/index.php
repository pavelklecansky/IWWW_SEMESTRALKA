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
        <h1>Admin Index</h1>
    </div>
</div>

<?php
//
//if($user->logout()){
//    header("location: ../login.php");
//}
//
//?>


<?php require_once "./template/footer.php" ?>
