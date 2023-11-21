<?php
// Start the session
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");
// Check the connection

// Retrieve the user ID from the form submission
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Retrieve the search term from the form submission
    if (isset($_GET['search'])) {
        $searchTerm = '%' . $_GET['search'] . '%'; // Use '%' for partial matching

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT own.*, game.poster FROM own INNER JOIN game ON own.gameID = game.gameID WHERE own.userID = ? AND own.gameID IN (SELECT gameID FROM game WHERE game.name LIKE ?)");



        if (!$stmt) {
            die("Error in statement preparation: " . $conn->error);
        }

        $stmt->bind_param("is", $userID, $searchTerm);

        if (!$stmt->execute()) {
            die("Error in statement execution: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // Output the results
        echo "<h2>Search Results:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Game ID: " . $row['gameID'] . ", Playtime: " . $row['playtime'] . ", Installed: " . $row['installed'] . "</li>";
        }
        echo "</ul>";

        $stmt->close();
    } else {
        echo "Search term not specified.";
    }
} else {
    echo "User ID not specified.";
}

$conn->close();
?>
