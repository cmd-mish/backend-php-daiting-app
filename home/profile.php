<!-- Funktioner-->
<?php include "functions.php" ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dejtapp - Profil</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div id="container">
    <!-- Logo och huvudmeny-->
    <?php include "../elements/header.php" ?>

    <!-- Sektionen omringar artiklar (eg. blogposts)-->
    <section>
        <?php if (!empty($_SESSION["username"])) :?>
        <!-- Profilvyn -->
            <?php if ($_REQUEST["page"] == "edit") :?>
                <?php include "view_edit_profile.php" ?>
                <?php include "view_edit_password.php" ?>
            <?php else :?>
                <?php include "view_profile.php" ?>
            <?php endif; ?>
        <?php else :?>
            <p>Du är inte inloggad! <a href="login.php">Logga in</a> för att se din profil!</p>
        <?php endif; ?>

    </section>

    <!-- Footern innehåller t.ex. somelänkar och kontaktuppg -->
    <?php include "../elements/footer.php" ?>

</div>
</body>

</html>