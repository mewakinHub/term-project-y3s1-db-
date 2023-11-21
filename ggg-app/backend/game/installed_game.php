<?php
//test
//http://localhost:8888/backend/game/installed_game.php?user_id=1
// Enable error reporting for debugging.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

if (isset($_GET['user_id'])) {
    $currentUserId = $_GET['user_id'];

    // Include 'g.gameID' in the SELECT statement to fetch it.
    $sql = "SELECT g.gameID, g.name, g.icon FROM own o
            JOIN game g ON o.gameID = g.gameID
            WHERE o.userID = ? AND o.installed = 1";

    $statement = $conn->prepare($sql);
    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $statement->bind_param("i", $currentUserId);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Installed Games List<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    echo "<div class='installed-games'>"; // Start the container for installed games
    while ($row = $result->fetch_assoc()) {
        echo "<div class='game'>"; // Game container
        // Display the game icon
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['icon']) . '" alt="' . htmlspecialchars($row['name']) . '" class="game-icon">';
        // Display the game name
        echo '<p class="game-name">' . htmlspecialchars($row['name']) . '</p>';

        // Form for uninstalling the game
        echo '<form method="POST" action="uninstall_game.php">';
        echo '<input type="hidden" name="userID" value="' . htmlspecialchars($currentUserId) . '">';
        // Make sure to output the gameID
        echo '<input type="hidden" name="gameID" value="' . htmlspecialchars($row['gameID']) . '">';
        echo '<input type="submit" name="uninstallGame" value="Uninstall">';
        echo '</form>';

        echo "</div>"; // End game container
    }
    echo "</div>"; // End the container for installed games
} else {
    echo "User ID not specified.";
}
?>
