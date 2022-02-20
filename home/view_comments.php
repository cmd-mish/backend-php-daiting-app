<?php
    $userid = $_SESSION["user_id"];
    $profileid = test_input($_REQUEST["id"]);

    if (!empty($profileid)) {
        $executable = $profileid;
    } else {
        $executable = $userid;
    }

    $sql = "SELECT comments.comment, comments.sender_id, users.username FROM comments INNER JOIN users ON comments.sender_id = users.id WHERE comments.receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$executable]);
?>

<article>
    <h2 id="comment">Kommentarerna</h2>
    <?php if ($stmt->rowCount() == 0) : ?>
        <p>Finns inga kommentarer att visa.</p>
    <?php endif; ?>
    <?php foreach ($stmt->fetchAll() as $comment) :?>
        <p><a href="profile.php?id=<?= $comment["sender_id"] ?>"><?= $comment["username"] ?></a><?= ": " . $comment["comment"]?></p>
    <?php endforeach; ?>
</article>