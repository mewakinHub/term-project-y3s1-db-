<?php
require_once('/Users/k.vinrath/Desktop/labproject/term-project-y3s1-db-/backend/user/ connect.php');


//print_r($_POST);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

 
    // Corrected SQL query
    $q = "INSERT INTO user (email, password, username) VALUES ('$email', '$password', '$username')";

    $result = $conn->query($q);

    if (!$result) {
        // Handle insert failure
        echo "INSERT failed. Error: " . $conn->error;
    } else {
        
        header("Location:/featured.php");
        exit();
    }
}
?>