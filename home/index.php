<!-- Funktioner-->
<?php include "functions.php" ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Projekt 1</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div id="container">
        <!-- Logo och huvudmeny-->
        <?php include "../elements/header.php" ?>

        <!-- Sektionen omringar artiklar (eg. blogposts)-->
        <section>
            <!-- Annonser -->
            <?php include "view_ads.php" ?>

        </section>

        <!-- Footern innehåller t.ex. somelänkar och kontaktuppg -->
        <?php include "../elements/footer.php" ?>

    </div>
</body>

</html>