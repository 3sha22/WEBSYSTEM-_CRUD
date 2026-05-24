<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gym_";

$conn = new mysqli($host, $user, $pass, $db,3306);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>