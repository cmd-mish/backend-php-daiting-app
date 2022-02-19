<article>
    <h2>Registrera dig</h2>
    <p>Fyll i registreringsformuläret för att skapa en profil</p>
    <p>
        <form action="login.php?page=register" method="POST">
            Användarnamn: <br><input type="text" name="username"><br>
            Lösenord: <br><input type="password" name="password"><br>
            Lösenord igen: <br><input type="password" name="password-repeat"><br><br>

            Fullständiga namn: <br><input type="text" name="fullname"><br>
            Stad: <br><input type="text" name="city"><br>
            Epost adress: <br><input type="text" name="email"><br>
            Årslön: <br><input type="number" name="salary"><br>
            Berätta om dig: <br><textarea name="ad-text" rows="5" cols="50"></textarea><br>
            Preferens: <input type="radio" id="men" name="preference" value="1"><label for="men">Män</label>
            <input type="radio" id="women" name="preference" value="2"><label for="women">Kvinnor</label>
            <input type="radio" id="both" name="preference" value="3"><label for="both">Båda</label>
            <input type="radio" id="other" name="preference" value="4"><label for="other">Annat</label>
            <input type="radio" id="all" name="preference" value="5"><label for="all">Alla</label><br><br>
            <input type="submit" value="Registrera dig">
        </form>
    </p>

    <p>Har du redan ett konto? <a href="login.php?page=login">Logga in här!</a></p>

</article>
<?php
    $error_code = 0;

    if (!empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) && !empty($_REQUEST["password-repeat"])) {
        $username = test_input($_REQUEST["username"]);
        $password = test_input($_REQUEST["password"]);
        $password = hash("sha256", $password);

        $password_repeat = test_input($_REQUEST["password-repeat"]);
        $password_repeat = hash("sha256", $password_repeat);

        $passwords_match = $password == $password_repeat;

        $fullname = test_input($_REQUEST["fullname"]);
        $city = test_input($_REQUEST["city"]);
        $email = test_input($_REQUEST["email"]);
        $text = test_input($_REQUEST["ad-text"]);
        $salary = test_input($_REQUEST["salary"]);
        $preference = test_input($_REQUEST["preference"]);

        $sql = "INSERT INTO users (id, username, fullname, password, email, city, text, salary, preference) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($passwords_match && $stmt->execute([$username, $fullname, $password, $email, $city, $text, $salary, $preference])) {
            print("Du har registrerats! ");
            print("Välkommen, " . $username . "!");
            $_SESSION["username"] = $username;
            header("Refresh:2; url=./index.php");
        } else {
            print("Registrering misslyckades! ");
            if (!$passwords_match) {
                print("Lösenorden matchar inte!");
            }
        }
    }

?>