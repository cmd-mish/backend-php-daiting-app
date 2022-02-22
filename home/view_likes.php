<?php
    // Hur många likes har den nuvarande profilen
    $sql = "SELECT * FROM likes WHERE receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$executable]);
    $total_likes = $stmt->rowCount();

    // Kollar om den nuvarande användaren har gillat den nuvarande profilen
    $sql = "SELECT * FROM likes WHERE sender_id = ? and receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userid, $executable]);
    $liked = $stmt->rowCount() != 0;
?>


<?php if ($liked) : ?>
    <div class="actions-box">
        <form action="profile.php?id=<?= $executable ?>" method="post">
            <button type="submit" name="like-button" id="like-button-active" value="2"><img src="../media/like.png" class="like-image" alt="Ogilla annonsen"></button>
        </form>
    </div>
<?php else :?>
    <div class="actions-box">
        <form action="profile.php?id=<?= $executable ?>" method="post">
            <button type="submit" name="like-button" id="like-button-inactive" value="1"><img src="../media/like-inactive.png" class="like-image" alt="Gilla annonsen"></button>
        </form>
    </div>
<?php endif; ?>
    <div class="actions-box"><?= $total_likes ?></div>
<?php
    $action = test_input($_REQUEST["like-button"]);

    if ($action == 1) {
        $sql = "INSERT INTO likes (id, sender_id, receiver_id) VALUES (NULL, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userid, $executable]);

        $new_rating = $liked + 1;

        $sql = "UPDATE users SET rating = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_rating, $executable]);

        header("Refresh:0");
    } elseif ($action == 2) {
        $sql = "DELETE FROM likes WHERE sender_id = ? and receiver_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userid, $executable]);
        header("Refresh:0");

        $new_rating = $liked - 1;

        $sql = "UPDATE users SET rating = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_rating, $executable]);
    }
?>