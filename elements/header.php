<header>
    <!-- Logo och meny i headern -->
    <a href="../home"><img src="../media/heart-icon.svg" alt="Website logo" /></a>
    <div id="logo">Dejtapp</div>

    <nav>
        <!-- Huvudmenyn -->
        <ul>
            <li><a href="../home/">Annonser</a></li>
            <?php if (!empty($_SESSION["username"])) :?>
                <li><a href="profile.php">Din profil (<?= $_SESSION["username"] ?>)</a></li>
                <li><a href="logout.php">Logga ut</a></li>
            <?php else :?>
                <li><a href="../home/login.php">Registrera/Logga in</a></li>
            <?php endif; ?>

        </ul>
    </nav>
</header>
