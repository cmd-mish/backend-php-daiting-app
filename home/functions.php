<?php
    session_start();


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ger preferens som en omfattande string
    function output_preference($value) {
        if ($value == 1) {
            return "män";
        } elseif ($value == 2) {
            return "kvinnor";
        } elseif ($value == 3) {
            return "båda";
        } elseif ($value == 4) {
            return "annat";
        } elseif ($value == 5) {
            return "alla";
        }
    }

    // Databasconfig
    $servername = "localhost";
    $dbname = "popovmik";
    $username = "popovmik";
    include "database_config.php";
    $conn = new PDO("mysql:host=" . $servername . ";dbname=" . 
        $dbname . ";charset=UTF8", $username, $password);
?>