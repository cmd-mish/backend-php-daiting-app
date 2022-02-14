<article>
    <h2>Registrera dig</h2>
    <p>Fyll i registreringsformuläret för att skapa en profil</p>
    <p>
        <form action="login.php" method="POST">
            Användarnamn: <input type="text" name="username"><br>
            Lösenord: <input type="password" name="password"><br><br>

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
    
    <?php
        if (!empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) && !empty($_REQUEST["email"])) {
            $username = test_input($_REQUEST["username"]);
            $fullname = test_input($_REQUEST["fullname"]); 
            $epost = test_input($_REQUEST["email"]); 
            $city = test_input($_REQUEST["city"]); 
            $text = test_input($_REQUEST["ad-text"]); 
            $salary = test_input($_REQUEST["salary"]); 
            $preference = test_input($_REQUEST["preference"]);

            $password = test_input($_REQUEST["password"]);
            $password = hash("sha256", $password);

            $sql = "INSERT INTO users (id, username, fullname, password, email, city, text, salary, preference) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$username, $fullname, $password, $epost, $city, $text, $salary, $preference])) {
                print("Du har registrerats!");
            }
        }
        
    ?>