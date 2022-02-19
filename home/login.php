<!-- Funktioner-->
<?php include "functions.php" ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dejtapp - Login</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div id="container">
        <!-- Logo och huvudmeny-->
        <?php include "../elements/header.php" ?>

        <!-- Sektionen omringar artiklar (eg. blogposts)-->
        <section>

            <?php if ($_REQUEST["page"] == "register"): ?>
                <!-- Registreringsformulär-->
                <?php include "view_register.php" ?>
            <?php else: ?>
                <!-- Loginformulär -->
                <?php include "view_login.php" ?>
            <?php endif; ?>
        </section>

        <!-- Footern innehåller t.ex. somelänkar och kontaktuppg -->
        <?php include "../elements/footer.php" ?>

    </div>
</body>

</html>