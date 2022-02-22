<?php
    $userid = $_SESSION["user_id"];
    $profileid = test_input($_REQUEST["id"]);

    if (!empty($profileid)) {
        $executable = $profileid;
    } else {
        $executable = $userid;
    }

    $sql = "SELECT comments.comment, comments.sender_id, comments.receiver_id, comments.timestamp, users.username FROM comments INNER JOIN users ON comments.sender_id = users.id WHERE comments.receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$executable]);
    $no_comments = $stmt->rowCount() == 0;
    $comment_array = $stmt->fetchAll();
?>
<?php if ($user) : ?>
<article>
    <h2 id="comment">Kommentarer</h2>
    <?php if ($no_comments) : ?>
        <p><i>Finns inga kommentarer att visa.</i></p>
    <?php endif; ?>
    <?php foreach ($comment_array as $comment) :?>
        <p><a href="profile.php?id=<?= $comment["sender_id"] ?>"><?= $comment["username"] ?></a><span class="timestamp"><?= " den " . $comment["timestamp"] ?></span><?= ": " . $comment["comment"]?></p>
    <?php endforeach; ?>
    <?php if($userid != $executable) :?>
        <form action="profile.php?id=<?= $executable ?>#comment" method="POST">
            <label for="comment-field">Skriv en kommentar</label><br><textarea name="comment-field" id="comment-field" rows="5" cols="50"></textarea><br>
            <input type="submit" value="Skicka">
        </form>
    <?php else: ?>
        <p><i>Du får skriva kommentarer bara på andras sidor.</i></p>
    <?php endif; ?>
</article>
<?php endif; ?>

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