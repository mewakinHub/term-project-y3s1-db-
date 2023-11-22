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

// Delete studio logic
// GET: data is sent as parameters in the URL. 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $studioID = $_GET["id"];

    // Use prepared statement to avoid SQL injection
    $stmt = $mysqli->prepare("DELETE FROM studio WHERE studioID=?");
    $stmt->bind_param("i", $studioID);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
// Close the database connection
$mysqli->close();
?>
