<?php
    $userid = $_SESSION["user_id"];
    $profileid = test_input($_REQUEST["id"]);

    if (!empty($profileid)) {
        $executable = $profileid;
    } else {
        $executable = $userid;
    }

    $sql = "SELECT comments.comment, comments.sender_id, comments.receiver_id, users.username FROM comments INNER JOIN users ON comments.sender_id = users.id WHERE comments.receiver_id = ?";
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
    <form action="profile.php?id=<?= $comment["receiver_id"] ?>#comment" method="POST">
        <label for="comment-field">Skriv en kommentar</label><br><textarea name="comment-field" id="comment-field" rows="5" cols="50"></textarea><br>
        <input type="submit" value="Skicka">
    </form>
</article>

<?php
    $comment = test_input($_REQUEST["comment-field"]);

    if (!empty($_REQUEST["comment-field"])) {
        $sql = "INSERT INTO comments (id, timestamp, sender_id, receiver_id, comment) VALUES (NULL, current_timestamp(), ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$userid, $executable, $comment])) {
            print("Comment sent");
            header("Refresh:2");

        } else {
            print("Error");
        }
    }
?>