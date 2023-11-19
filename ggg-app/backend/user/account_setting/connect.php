<?php
$host = "127.0.0.1";
$user = "user";
$password = "userggg";
$database = "ggg";
$port = 8889;

// Create a connection
$conn = new mysqli($host, $user, $password, $database, $port);
// var_dump($conn);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected to MySQL";
}

// // Test query to fetch data from the user table
// $query = "SELECT * FROM user LIMIT 1";
// $result = $conn->query($query);

// if ($result) {
//     // Fetch one record as an associative array
//     $row = $result->fetch_assoc();
//     echo "Data fetched:\n";
//     print_r($row);

//     // Free the memory associated with the result
//     $result->free();
// } else {
//     echo "Error: " . $conn->error;
// }
?>

