<article>
    <h2>Annonserna</h2>
    <p>Här kommer datan</p>
    
    <?php
        $sql = "SELECT * FROM users"; // SQL kommandot vi vill köra
        $stmt = $conn->query($sql); // Query är metoden. Returnerar FALSE eller mysqli_result objekt
                
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print("<div class=\"ad-in-list\"><h4>" .
            $row["fullname"] . "</h4>" .
            $row["city"] . ", tjänar " . $row["salary"] . " per månad, intresserad av " . $row["preference"] .
            "</div>");
        }
    ?>

    

</article>