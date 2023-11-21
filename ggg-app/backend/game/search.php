<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

// Check if the 'userID' parameter is set
if (isset($_GET['userID'])) {
    $currentUserId = $_GET['userID'];

    // Fetch games that are owned but not installed
    $sql = "SELECT g.gameID, g.name, g.icon FROM own o
            JOIN game g ON o.gameID = g.gameID
            WHERE o.userID = ? AND o.installed = 0";

    $statement = $conn->prepare($sql);
    
    if ($statement === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $statement->bind_param("i", $currentUserId);
    $statement->execute() or die("Error: " . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    // Display the owned but not installed games
    echo "<div class='owned-games'>"; // Start the container for owned but not installed games
    while ($row = $result->fetch_assoc()) {
        echo "<div class='game'>"; // Game container
        // Display the game icon
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['icon']) . '" alt="' . htmlspecialchars($row['name']) . '" class="game-icon">';
        // Display the game name
        echo '<p class="game-name">' . htmlspecialchars($row['name']) . '</p>';

        // Form for installing the game
        echo '<form method="POST" action="install_game.php">';
        echo '<input type="hidden" name="userID" value="' . htmlspecialchars($currentUserId) . '">';
        // Make sure to output the gameID
        echo '<input type="hidden" name="gameID" value="' . htmlspecialchars($row['gameID']) . '">';
        echo '<input type="submit" name="installGame" value="Install">';
        echo '</form>'; 

        echo "</div>"; // End game container
    }
    echo "</div>"; // End the container for owned but not installed games
} else {
    echo "User ID not specified.";
}
?>
