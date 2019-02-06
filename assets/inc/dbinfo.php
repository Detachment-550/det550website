<?php
$host = "db2.internal";
$user = "afrotc_admin";
$password = "Det550";
$database = "afrotc_mitr";
// Create connection
$mysqli = mysqli_connect($host, $user, $password, $database);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>
