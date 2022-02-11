<header>
    <!-- Logo och meny i headern -->
    <img src="../media/logo.svg" alt="Website logo" />
    <div id="logo">DenApp</div>

    <nav>
        <!-- Huvudmenyn -->
        <ul>
            <li><a href="../home/">Home</a></li>
            <li><a href="../projekt1/">Projekt 1</a></li>
            <li><a href="../projekt2/">Projekt 2</a></li>
            <li><a href="../rapport/">Rapport</a></li>
            <!-- Visa profilsidan om man är inloggad -->
            <?php
              if (isset($_COOKIE['PHPSESSID'])) {
                  // Visa länken till profilsidan om man är inloggad
                  print("<li><a href='./profile.php'>My Profile</a></li>");
              }
            ?>
        </ul>
    </nav>
</header>