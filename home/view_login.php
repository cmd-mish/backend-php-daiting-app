<article>
    <h2>Logga in</h2>
    <p>Om du redan har ett konto kan du logga in här!</p>
        <form action="login.php" method="GET">
            <label for="username-login">Användarnamn</label><br><input type="text" name="username-login" id="username-login"><br>
            <label for="password-login">Lösenord</label><br><input type="password" name="password-login" id="password-login"><br><br>
            <input type="submit" value="Logga in">
        </form>
    <p>Inget konto? <a href="login.php?page=register">Registrera dig här!</a></p>

    <?php
        if (!empty($_REQUEST["username-login"]) && !empty($_REQUEST["password-login"])) {
            $username = test_input($_REQUEST["username-login"]);
            $password = test_input($_REQUEST["password-login"]);
            $password = hash("sha256", $password);

            $sql = "SELECT id, username, password, fullname FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                print("Välkommen, " . $row["fullname"] . "!");
                $_SESSION["username"] = $row["username"];
                $_SESSION["user_id"] = $row["id"];
                header("Refresh:1; url=./index.php");
            } else {
                print("Fel användarnamn eller lösenord!");
            }
        }
    ?>

</article>