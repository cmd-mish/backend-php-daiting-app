<article>
    <h2>Annonserna</h2>
    <?php
        $sql = "SELECT id, username, fullname, email, city, text, salary, preference, rating FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    ?>
    <p class="ad-filter">
        <form action="index.php">
            <label for="limit">Antal annonser per sida:</label>
            <input type="number" id="limit" value="<?= $_SESSION["ads_max"] ?>">
            <input type="submit" value="OK">
        </form>
    </p>
    <div class="ads-grid">
        <?php foreach ($stmt->fetchAll() as $user) : ?>
            <div class="ad-in-grid">
                <h4><?= $user["fullname"]?></h4>
                <p class="user-details">
                    Från <?= $user["city"]?>,
                    intresserad av <?= output_preference($user["preference"])?><?php if ($user["salary"] != NULL) :?>, årslön <?= $user["salary"]?>&euro;<?php endif; ?>, gillat av <?= $user["rating"] ?>.
                </p>
                <?php if (!empty($_SESSION["username"])) :?>
                    <p class="actions">
                        <a href="profile.php?id=<?= $user["id"] ?>"><img src="../media/profile.png" alt="Visa profilsidan"></a>
                        <a href="mailto:<?= $user["email"]?>"><img src="../media/email.png" alt="Skicka ett mejl"></a>
                        <a href="profile.php?id=<?= $user["id"] ?>#comment"><img src="../media/comment.png" alt="Lämna en kommentar"></a>
                    </p>
                <?php else: ?>
                    <p class="actions">
                        <img src="../media/profile-inactive.png" alt="Logga in för att kunna se profilsidan">
                        <img src="../media/email-inactive.png" alt="Logga in för att kunna skicka ett mejl">
                        <img src="../media/comment-inactive.png" alt="Logga in för att kunna lämna en kommentar">
                    </p>
                <?php endif; ?>
                <?php if ($user["text"] != NULL) :?>
                    <div class="text-in-ad">
                        "<?= substr($user["text"], 0, 250)?>"
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
    

</article>