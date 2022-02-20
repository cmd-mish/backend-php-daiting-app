<article>
    <h2>Andra lösenord</h2>
    <form action="profile.php?page=edit" method="POST">
        <label for="old-password">Gammalt lösenord<span class="obligatory">*</span></label><br><input type="password" name="old-password" id="old-password"><br>
        <label for="new-password">Nytt lösenord<span class="obligatory">*</span></label><br><input type="password" name="new-password" id="new-password"><br>
        <label for="new-password-repeat">Nytt lösenord igen<span class="obligatory">*</span></label><br><input type="password" name="new-password-repeat" id="new-password-repeat"><br><br>
        <input type="submit" value="Spara">
    </form>
</article>

<?php
    $username = $_SESSION["username"];

    $old_password = test_input($_REQUEST["old-password"]);
    $old_password = hash("sha256", $old_password);

    $new_password = test_input($_REQUEST["new-password"]);
    $new_password = hash("sha256", $new_password);

    $new_password_repeat = test_input($_REQUEST["new-password-repeat"]);
    $new_password_repeat = hash("sha256", $new_password_repeat);

    $passwords_match = $new_password == $new_password_repeat;

    if (!empty($_REQUEST["old-password"] && !empty($_REQUEST["new-password"]) && $passwords_match)) {
        $sql = "SELECT password FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $old_password]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sql = "UPDATE users SET password = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$new_password, $username])) {
                print("Success!");
                header("Refresh:0; url=./profile.php");
            } else {
                print("Nåt gick fel!");
            }
        }
    }
?>