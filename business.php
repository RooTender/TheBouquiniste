<?php

function getDB() {
    mb_internal_encoding("UTF-8");

    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $database = "test";

    $connection = new mysqli($servername, $username, $password, $database);
    $connection->set_charset("utf8");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}

function db_request($request) {

    $connection = getDB();
    $result = $connection->query($request);
    
    if ($result === TRUE) {
        echo "Query: '$request' - successfully invoked!";
        $_SESSION['response'] = true;

    } else {

        if (!empty($connection->error)) {
            echo "ERROR: Could not able to execute '$request'. " . $connection->error;
            $_SESSION['response'] = false;
        }
    }

    return $result;
}