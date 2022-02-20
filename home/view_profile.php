<?php
$username = $_SESSION["username"];

$sql = "SELECT fullname, city, email, salary, text, preference FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
?>

<article>
    <h2>Här är din profil, <?= $username ?>!</h2>
    <?php if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="ad-full-page">
            <h4><?= $user["fullname"]?></h4>
            <p class="user-details">
                Från <?= $user["city"]?>,
                intresserad av <?= output_preference($user["preference"])?><?php if ($user["salary"] != NULL) :?>, årslön <?= $user["salary"]?><?php endif; ?>.
            </p>
            <?php if ($user["text"] != NULL) :?>
                <p>
                    <?= $user["text"]?>
                </p>
            <?php endif; ?>
            <p class="actions">
                <a href="mailto:<?= $user["email"]?>"><img src="../media/email.png" alt="Skicka ett mejl"></a>
            </p>
        </div>
    <?php endif; ?>
    <p><a href="profile.php?page=edit">Ändra profilen</a></p>
</article>