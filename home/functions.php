<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Databasconfig
    $servername = "localhost";
    $dbname = "popovmik";
    $username = "popovmik";
    include "database_config.php";
    $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=UTF8", $username, $password); // Uppkopplingen mellan php och mysql databasen (konstr. metoden)
?>