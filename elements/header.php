<header>
    <!-- Logo och meny i headern -->
    <img src="../media/php-icon.svg" alt="Website logo" />
    <div id="logo">Dejtapp</div>

    <nav>
        <!-- Huvudmenyn -->
        <ul>
            <li><a href="../home/">Annonser</a></li>
            <?php if (!empty($_SESSION["username"])) :?>
                <li><a href="logout.php"><?= $_SESSION["username"] ?></a></li>
            <?php else :?>
                <li><a href="../home/login.php">Registrera/Logga in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
