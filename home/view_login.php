<article>
    <h2>Logga in</h2>
    <p>Om du redan har ett konto kan du logga in här!</p>
    <p>
        <form action="login.php" method="GET">
            Användarnamn: <input type="text" name="username-login"><br>
            Lösenord: <input type="password" name="password-login"><br>
            <input type="submit" value="Logga in">
        </form>
    </p>
    <p>Inget konto? <a href="login.php?page=register">Registrera dig här!</a></p>

    <?php
        if (!empty($_REQUEST["username-login"]) && !empty($_REQUEST["password-login"])) {
            $username = test_input($_REQUEST["username-login"]);
            $password = test_input($_REQUEST["password-login"]);
            $password = hash("sha256", $password);

            $sql = "SELECT username, password, fullname FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                print("Loggad in som " . $row["fullname"]);
                $_SESSION["username"] = $row["username"];
                header("Refresh:0; url=./index.php");
            }
        }
    ?>

</article>