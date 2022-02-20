<article>
    <h2>Ta bort profilen</h2>
    <form action="profile.php?page=edit" method="POST">
        <label for="password-delete">Skriv din lösenord här om du vill ta bort din profil</label> <input type="password" name="password" id="password-delete">
        <input type="submit" value="Ta bort profilen">
    </form>
</article>

<?php
    $username = $_SESSION["username"];

    $password = test_input($_REQUEST["password"]);
    $password = hash("sha256", $password);

    if (!empty($_REQUEST["password"])) {
        $sql = "SELECT password FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sql = "DELETE FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$username])) {
                print("Profilen har tagits bort! Hejdå!");
                header("Refresh:2; url=./logout.php");
            }
        }
    }
?>