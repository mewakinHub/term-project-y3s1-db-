<!-- delete_game.php -->
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

// Logout logic
if (isset($_GET["logout"]) && $_GET["logout"] == true) {
    $_SESSION["admin_loggedin"] = false;
    session_destroy();
    header("Location: login.php");
    exit;
}

// Delete game logic
// GET: data is sent as parameters in the URL. 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Use intval to ensure that the parameter is an integer to prevent SQL injection
    $gameID = intval($_GET["id"]);

    // Use prepared statement to avoid SQL injection
    $deleteGameSql = "DELETE FROM game WHERE gameID=?";
    $stmtDeleteGame = $mysqli->prepare($deleteGameSql);
    $stmtDeleteGame->bind_param('i', $gameID);

    if ($stmtDeleteGame->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmtDeleteGame->error . "</p>";
    }

    $stmtDeleteGame->close();
}
// Close the database connection
$mysqli->close();
?>
