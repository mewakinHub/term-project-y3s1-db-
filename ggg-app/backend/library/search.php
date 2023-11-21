<?php
// Start the session
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

// Output the current userID in the session
// echo "User ID in session: " . $_SESSION['userID'] . "<br>";

// Check if the 'userID' is set in the URL
if (isset($_GET['userID'])) {
    $userId = $_GET['userID'];

    // Set the user ID in the session for future use
    $_SESSION['userID'] = $userId;
} elseif (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    // If user ID is not in session or URL, exit with an error message
    die("User ID not specified.");
}

// Fetch games that the user owns (installed and not installed)
$sql = "SELECT g.gameID, g.name, g.icon FROM game g
        LEFT JOIN own o ON g.gameID = o.gameID
        WHERE o.userID = ?";

$statement = $conn->prepare($sql);

if ($statement === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

$statement->bind_param("i", $currentUserId);
$statement->execute() or die("Error: " . htmlspecialchars($statement->error));
$result = $statement->get_result();

// Display the owned games
echo "<div class='owned-games'>"; // Start the container for owned games
while ($row = $result->fetch_assoc()) {
    echo "<div class='game'>"; // Game container
    // Display the game icon
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['icon']) . '" alt="' . htmlspecialchars($row['name']) . '" class="game-icon">';
    // Display the game name
    echo '<p class="game-name">' . htmlspecialchars($row['name']) . '</p>';

    // Add other game information as needed

    echo "</div>"; // End game container
}
echo "</div>"; // End the container for owned games
?>
