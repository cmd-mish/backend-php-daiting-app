<?php
$userid = $_SESSION["user_id"];
$profileid = test_input($_REQUEST["id"]);

if (!empty($profileid)) {
    $executable = $profileid;
} else {
    $executable = $userid;
}

$sql = "SELECT username, fullname, city, email, salary, text, preference FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$executable]);
?>

<article>
    <?php if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <?php if ($userid == $executable) :?>
            <h2>Här är din profil, <?= $user["username"] ?>!</h2>
        <?php else : ?>
            <h2>Här är <?= $user["username"] ?>s profil!</h2></h2>
        <?php endif; ?>

        <?php if ($userid == $executable) :?>
            <p class="edit-profile-link"><a href="profile.php?page=edit">Ändra profilen</a></p>
        <?php endif; ?>

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
                <?php include "view_likes.php" ?>
            </p>
        </div>
    <?php endif; ?>
</article>