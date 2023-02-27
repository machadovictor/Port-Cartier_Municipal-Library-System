<?php
    //Database conection
    $username = 'root';
    $password = '';
    $database = 'project_integ_db';
    $host = 'localhost';

    $mysqli = new mysqli($host, $username, $password, $database);

    // Check if the connection was successfully established
    if ($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->error);
    }
?>