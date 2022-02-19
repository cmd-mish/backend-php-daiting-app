<article>
    <h2>Registrera dig</h2>
    <p>Fyll i registreringsformuläret för att skapa en profil</p>
    <p>
        <form action="login.php?page=register" method="POST">
            Användarnamn: <input type="text" name="username"><br>
            Lösenord: <input type="password" name="password"><br>
            Lösenord igen: <input type="password" name="password-repeat"><br><br>

            Fullständiga namn: <input type="text" name="fullname"><br>
            Stad: <input type="text" name="city"><br>
            Epost adress: <input type="text" name="email"><br>
            Årslön: <input type="number" name="salary"><br>
            Berätta om dig: <textarea name="ad-text"></textarea><br>
            Preferens: <input type="radio" id="men" name="preference" value="1"><label for="men">Män</label>
            <input type="radio" id="women" name="preference" value="2"><label for="women">Kvinnor</label>
            <input type="radio" id="both" name="preference" value="3"><label for="both">Båda</label>
            <input type="radio" id="other" name="preference" value="4"><label for="other">Annat</label>
            <input type="radio" id="all" name="preference" value="5"><label for="all">Alla</label><br>


            <input type="submit" value="Registrera dig">
        </form>
    </p>

    <p>Har du redan ett konto? <a href="login.php?page=login">Logga in här!</a></p>

</article>
<?php
    if (!empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) && !empty($_REQUEST["password-repeat"])) {
        $username = test_input($_REQUEST["username"]);
        $password = test_input($_REQUEST["password"]);
        $password = hash("sha256", $password);

        $password_repeat = test_input($_REQUEST["password-repeat"]);
        $password_repeat = hash("sha256", $password_repeat);

        $passwords_match = $password == $password_repeat;

        $fullname = test_input($_REQUEST["fullname"]);
        if (empty($fullname)) $fullname = NULL;

        $city = test_input($_REQUEST["city"]);
        if (empty($city)) $city = NULL;

        $email = test_input($_REQUEST["email"]);
        if (empty($email)) $email = NULL;

        $text = test_input($_REQUEST["ad-text"]);
        if (empty($text)) $text = NULL;

        $salary = test_input($_REQUEST["salary"]);
        if (empty($salary)) $salary = NULL;

        $preference = test_input($_REQUEST["preference"]);
        if (empty($preference)) $preference = NULL;

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