<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "appointment_system";
$port = 3307;

$conn = new mysqli($host, $username, $password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 🔥 MAKE GLOBAL ACCESS SAFE
$GLOBALS['conn'] = $conn;
?>