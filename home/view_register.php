<article>
    <h2>Registrera dig</h2>
    <p>Fyll i registreringsformuläret för att skapa en profil</p>
        <form action="login.php?page=register" method="POST">
            <label for="username">Användarnamn<span class="obligatory">*</span></label><br><input type="text" name="username" id="username"><br>
            <label for="password">Lösenord<span class="obligatory">*</span></label><br><input type="password" name="password" id="password"><br>
            <label for="password-repeat">Lösenord igen<span class="obligatory">*</span></label><br><input type="password" name="password-repeat" id="password-repeat"><br><br>

            <label for="fullname">Fullständiga namn<span class="obligatory">*</span></label><br><input type="text" name="fullname" id="fullname"><br>
            <label for="city">Stad<span class="obligatory">*</span></label><br><input type="text" name="city" id="city"><br>
            <label for="email">E-post adress<span class="obligatory">*</span></label><br><input type="text" name="email" id="email"><br>
            <label for="salary">Årslön</label><br><input type="number" name="salary" id="salary"><br>
            <label for="ad-text">Berätta om dig</label><br><textarea name="ad-text" rows="5" cols="50" id="ad-text"></textarea><br>
            Preferens<span class="obligatory">*</span> <input type="radio" id="men" name="preference" value="1"><label for="men">Män</label>
            <input type="radio" id="women" name="preference" value="2"><label for="women">Kvinnor</label>
            <input type="radio" id="both" name="preference" value="3"><label for="both">Båda</label>
            <input type="radio" id="other" name="preference" value="4"><label for="other">Annat</label>
            <input type="radio" id="all" name="preference" value="5"><label for="all">Alla</label><br><br>
            <input type="submit" value="Registrera dig">
        </form>
    <br><span class="obligatory">*</span> betyder att fältet är obligatoriskt
    <p>Har du redan ett konto? <a href="login.php?page=login">Logga in här!</a></p>

</article>
<?php

    if (!empty($_REQUEST["username"]) && !empty($_REQUEST["password"])) {
        $username = test_input($_REQUEST["username"]);
        $user_exists = false;

        // Kollar om användarnamn är redan i bruk
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $user_exists = true;
        }

        $password = test_input($_REQUEST["password"]);
        $password = hash("sha256", $password);

        $password_repeat = test_input($_REQUEST["password-repeat"]);
        $password_repeat = hash("sha256", $password_repeat);

        $passwords_match = $password == $password_repeat;

        $fullname = test_input($_REQUEST["fullname"]);
        $city = test_input($_REQUEST["city"]);
        $email = test_input($_REQUEST["email"]);
        $text = test_input($_REQUEST["ad-text"]);
        if (empty($text)) $text = NULL;
        $salary = test_input($_REQUEST["salary"]);
        if (empty($salary)) $salary = NULL;
        $preference = test_input($_REQUEST["preference"]);

        $sql = "INSERT INTO users (id, username, fullname, password, email, city, text, salary, preference) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$user_exists && $passwords_match && $stmt->execute([$username, $fullname, $password, $email, $city, $text, $salary, $preference])) {
            print("Du har registrerats! ");
            print("Välkommen, " . $username . "!");
            $_SESSION["username"] = $username;
            header("Refresh:2; url=./index.php");
        } else {
            print("Registrering misslyckades! ");
            if ($user_exists) {
                print("<br>Användaren med det här användarnamnet redan finns!");
            }
            if (!$passwords_match) {
                print("<br>Lösenorden matchar inte!");
            }
            if (empty($fullname)) {
                print("<br>Fullständiga namn fältet är tomt");
            }
            if (empty($city)) {
                print("<br>Stad fältet är tomt");
            }
            if (empty($email)) {
                print("<br>E-post fältet är tomt");
            }
            if (empty($preference)) {
                print("<br>Preferens är tom");
            }
        }
    }

?>