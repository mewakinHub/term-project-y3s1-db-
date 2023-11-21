<!-- delete_studio.php -->
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "ggg";

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($mysqli->errno) {
    echo("Connection failed: " . $mysqli->connect_error);
}

session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Check if the studioID parameter is set
if (isset($_GET['id'])) {
    $studioID = $_GET['id'];

    // Use prepared statement to delete the studio
    $stmt = $mysqli->prepare("DELETE FROM studio WHERE studioID = ?");
    $stmt->bind_param("i", $studioID);

    if ($stmt->execute()) {
        echo "Studio deleted successfully!";
    } else {
        echo "Error deleting studio: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Studio ID not provided.";
}

// Close the database connection
$mysqli->close();
?>
