<?php
    $servername = "database";
    $username = "root";
    $password = "root";
    $dbname = "Study_Hub";

    try {
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
        
        $conn = new PDO($dsn, $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Lỗi liên kết database: " . $e->getMessage());
    }
?>