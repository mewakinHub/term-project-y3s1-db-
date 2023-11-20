<?php
require_once("connect.php");

// Make sure to start the session if you're using session variables.
session_start();

if (isset($_POST['uninstallGame'])) { // Change 'deleteFriend' to 'uninstallGame'
    $currentUserId = $_POST['userID']; // Change 'currentUserId' to 'userID'
    $gameID = $_POST['gameID']; // Change 'friendUserId' to 'gameID'

    error_log("Attempting to uninstall game ID: $gameID for user ID: $currentUserId"); // Log for debugging

    // Update the SQL to set the installed flag to 0
    $sql = "UPDATE `own` SET `installed` = 0 WHERE `userID` = ? AND `gameID` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Handle errors in preparation.
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }

    $stmt->bind_param("ii", $currentUserId, $gameID); // Bind the correct variables
    $stmt->execute();

    // Check if any rows were affected.
    if ($stmt->affected_rows > 0) {
        echo "Game uninstalled successfully.";
        header("Location: /backend/game/installed_game.php?user_id=" . urlencode($currentUserId)); // Redirect to installed games page
        exit; // Ensure script termination after redirection
    } else {
        echo "No game was uninstalled. Please check the game ID.";
    }

    $stmt->close();
} else {
    echo "No game selected for uninstallation.";
}

?>
