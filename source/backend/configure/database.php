<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

$servername = getenv('DB_HOST') ?: "database";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: ""; 
$dbname = getenv('DB_NAME') ?: "Study_Hub";

try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu."); 
}
?>