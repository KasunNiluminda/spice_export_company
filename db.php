<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "spice_export_db";
$port = 3307; 

// Create a new connection instance
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
