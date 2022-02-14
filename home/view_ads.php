<article>
    <h2>Annonserna</h2>
    <p>Här kommer datan</p>
    
    <?php
        $sql = "SELECT * FROM users"; // SQL kommandot vi vill köra
        $stmt = $conn->query($sql); // Query är metoden. Returnerar FALSE eller mysqli_result objekt
                
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print("Användarnamn: " . $row["username"] . " " . $row["city"] . "<br>");
        }


    ?>

</article>