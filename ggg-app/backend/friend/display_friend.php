<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

if (isset($_GET['user_id'])) {
    $currentUserId = $_GET['user_id']; // Assign the value to $currentUserId
    $sql = "SELECT u.username
            FROM user u
            JOIN friend f ON u.userID = f.toID OR u.userID = f.fromID
            WHERE (f.fromID = ? OR f.toID = ?) AND u.userID != ?;";

    $statement = $conn->prepare($sql);

    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

// Bind the current user ID to the SQL query
    // You need three parameters since there are three placeholders
    $statement->bind_param("iii", $currentUserId, $currentUserId, $currentUserId);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Friends List<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    echo "<ul>"; // Start the list
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        if (!empty($row['profilePicFile'])) {
            // Display the user's profile picture if available
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profilePicFile']) . '" alt="Profile picture" style="width: 50px; height: 50px; border-radius: 50%;"> ';
        } else {
            // Display a default image or icon if no profile picture is available
            echo '<img src="/Users/k.vinrath/Desktop/labproject2/term-project-y3s1-db-/ggg-app/backend/friend/user.png" style="width: 50px; height: 50px; border-radius: 50%;"> ';
        }
        // Display the user's username
        echo htmlspecialchars($row['username']);
        echo "</li>";
    }
    echo "</ul>"; // End the list
} else {
    echo "User ID not specified.";
}
?>