<?php
    $servername = "database";
    $username = "root";
    $password = "root";
    $dbname = "Study_Hub";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Lỗi liên kết database: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");
?>