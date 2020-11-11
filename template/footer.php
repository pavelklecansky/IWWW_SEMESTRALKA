<footer>
    <p>Build by <a href="https://github.com/pavelklecansky">Pavel Klečanský</a></p>
    <?php
        if ($user->isLogged()){
            echo '<a href="./admin/index.php">Admin</a>';
        }else{
            echo '<a href="./admin/login.php">Login</a>';
        }

    ?>

</footer>
</body>
</html>