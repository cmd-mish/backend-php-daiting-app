<article>
    <h2>Annonserna</h2>
    <p>Här kommer datan</p>
    
    <?php
        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";

    ?>

</article>