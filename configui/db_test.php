<?php
$servername = "localhost";
$username = "root3";
$password = "root3";
$dbname = "evolved5g";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection
$conn->close();
?>
