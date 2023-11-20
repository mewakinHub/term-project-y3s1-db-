<?php
$host = "127.0.0.1";
$user = "ggguser";
$password = "ggguser"; 
$database = "ggg";
$port = 8889;

// Create a connection
$conn = new mysqli($host, $user, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Echo the success message
    // echo "Connected to MySQL";
}

// Note: Do not close the connection here
// $conn->close();
?>
