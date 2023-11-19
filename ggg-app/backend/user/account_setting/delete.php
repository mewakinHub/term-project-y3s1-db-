<?php
session_start(); 

// $host = "127.0.0.1";
// $user = "user";
// $password = "userggg";
// $database = "ggg";
// $port = 8889;

// // Create a connection
// $conn = new mysqli($host, $user, $password, $database, $port);


require_once('connect.php');
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL";
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_SESSION['ID'] = 23;

// Uncomment for debugging
echo "<pre>Session variables in 'delete.php': ";
print_r($_SESSION);
echo "</pre>";

if (isset($_SESSION['ID'])) {
    $idInSession = $_SESSION['ID'];

    // Prepare a statement for delete
    $stmt = $conn->prepare("DELETE FROM `user` WHERE `userID` = ?");
    $stmt->bind_param("i", $idInSession);

    if (!$stmt->execute()) {
        echo "DELETE failed. Error: " . $stmt->error;
    } else {
        // Success message
        echo "User with ID $idInSession has been successfully deleted.";

        // Clear all session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Redirect to profile page or home page after deletion
        // header("Location: profile.php");
        exit;
    }

    $stmt->close();
} else {
    echo "User is not logged in.";
}

$conn->close();
?>
