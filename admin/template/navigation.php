<!-- Převzato z https://github.com/pure-css/pure/blob/master/site/static/layouts/side-menu/index.html -->
<!-- Menu toggle -->
<a href="#menu" id="menuLink" class="menu-link">
    <!-- Hamburger icon -->
    <span></span>
</a>

<nav id="menu">
    <div class="pure-menu">
        <a class="pure-menu-heading" href="./index.php">Admin</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="./index.php" class="pure-menu-link">Blog</a></li>
            <li class="pure-menu-item"><a href="./categories.php" class="pure-menu-link">Kategorie</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Tagy</a></li>
            <?php
            if ($user->isAdmin()) {
                echo '<li class="pure-menu-item"><a href="./users.php" class="pure-menu-link">Uživatele</a></li>';
            }

            ?>
            <li class="pure-menu-item"><a href="./includes/logout.php" class="pure-menu-link">Odhlásit</a></li>
        </ul>
    </div>
</nav>