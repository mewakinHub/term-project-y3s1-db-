<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");
$userID = $_SESSION['userID'];
$gameID = $_SESSION['gameID'];
if (isset($_GET['userID'])) {
    $currentUserId = $_GET['userID'];

    // Fetch the current user's information
    $sql = "SELECT userID, username, bio, profilePicFile FROM user WHERE userID = ?;";

    $statement = $conn->prepare($sql);
    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $statement->bind_param("i", $currentUserId);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving User Information<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    if ($user = $result->fetch_assoc()) {
        echo "<div>";
        if (!empty($user['profilePicFile'])) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($user['profilePicFile']) . '" alt="Profile picture" style="width: 150px; height: 150px; border-radius: 50%;"> ';
        } else {
            echo '<img src="/backend/friend/default-user.png" alt="Default profile picture" style="width: 150px; height: 150px; border-radius: 50%;">';
        }
        echo "<p>Username: " . htmlspecialchars($user['username']) . "</p>";
        echo "<p>Bio: " . (empty($user['bio']) ? 'Not provided' : htmlspecialchars($user['bio'])) . "</p>";
        echo "</div>";
    } else {
        echo "No user found with the specified ID.";
    }
} else {
    echo "User ID not specified.";
}

?>
