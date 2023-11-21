<?php

require_once("connect.php");

// Make sure to start the session if you're using session variables.
session_start();

if (isset($_POST['deleteFriend'])) {
    $currentUserId = $_POST['currentUserId'];
    $friendUserId = $_POST['friendUserId'];

    error_log("Attempting to delete friendship between user ID: $currentUserId and friend ID: $friendUserId"); // Log for debugging

    $sql = "DELETE FROM friend WHERE (fromID = ? AND toID = ?) OR (fromID = ? AND toID = ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Handle errors in preparation.
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }

    $stmt->bind_param("iiii", $currentUserId, $friendUserId, $friendUserId, $currentUserId);
    $stmt->execute();

    // Check if any rows were affected.
    if ($stmt->affected_rows > 0) {
        echo "Friendship removed successfully.";
        header("Location: /backend/friend/display_friend.php?userID=" . urlencode($currentUserId));
    } else {
        echo "No friendship was removed. Please check the friend IDs.";
    }

    $stmt->close();
} else {
    echo "No friend selected for deletion.";
}

?>