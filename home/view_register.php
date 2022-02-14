<article>
    <h2>Registrera dig</h2>
    <p>Fyll i registreringsformuläret för att skapa en profil</p>
    <p>
        <form action="login.php" method="POST">
            Användarnamn: <input type="text" name="username"><br>
            Lösenord: <input type="text" name="password"><br>
            Epost: <input type="epost" name="epost"><br>
            <input type="submit" value="Registrera dig">
        </form>
    </p>
    
    <?php
        if (!empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) && !empty($_REQUEST["epost"])) {
            $username = test_input($_REQUEST["username"]);
            $fullname = "Test User"; 
            $epost = test_input($_REQUEST["epost"]); 
            $city = "Helsinki"; 
            $text = "Hej"; 
            $salary = 1000; 
            $preference = 3;

            $password = test_input($_REQUEST["epost"]);
            $password = hash("sha256", $password);
            print($password); 

            $sql = "INSERT INTO users (id, username, fullname, password, email, city, text, salary, preference) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$username, $fullname, $password, $epost, $city, $text, $salary, $preference])) {
                print("Du har registrerats!");
            }
        }
        
    ?>