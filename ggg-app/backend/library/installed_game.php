<?php
// Display installed games
// Test with the updated URL parameter: userID
// http://localhost:8888/backend/library/installed_game.php?userID=1

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

// Check for 'userID' instead of 'user_id'
if (isset($_GET['userID'])) {
    // Use the 'userID' parameter to fetch the current user's ID
    $currentUserId = $_GET['userID'];

    // The SQL query remains unchanged as it uses the variable, not the superglobal directly
    $sql = "SELECT g.gameID, g.name, g.icon FROM own o
            JOIN game g ON o.gameID = g.gameID
            WHERE o.userID = ? AND o.installed = 1";

    $statement = $conn->prepare($sql);
    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // The rest of the code remains the same, as it uses the variable $currentUserId
    $statement->bind_param("i", $currentUserId);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Installed Games List<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    echo "<div class='installed-games'>"; // Start the container for installed games
    while ($row = $result->fetch_assoc()) {
        echo "<div class='game'>"; // Game container
        // Display the game icon and name using the existing code
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['icon']) . '" alt="' . htmlspecialchars($row['name']) . '" class="game-icon">';
        echo '<p class="game-name">' . htmlspecialchars($row['name']) . '</p>';

        // The form action and methods remain unchanged
        echo '<form method="POST" action="uninstall_game.php">';
        echo '<input type="hidden" name="userID" value="' . htmlspecialchars($currentUserId) . '">';
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
