<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

if (isset($_GET['user_id'])) {
    $currentUserId = $_GET['user_id']; // Assign the value to $currentUserId
    $sql = "SELECT u.userID, u.username, u.profilePicFile 
            FROM user u
            JOIN friend f ON u.userID = f.toID OR u.userID = f.fromID
            WHERE (f.fromID = ? OR f.toID = ?) AND u.userID != ?;"; // Removed the extra quote

    $statement = $conn->prepare($sql);

    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind the current user ID to the SQL query
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
            echo '<img src="/backend/friend/user%20(2).png" style="width: 50px; height: 50px; border-radius: 50%;">';

        }
        // Display the user's username
        echo htmlspecialchars($row['username']);
        
        // Check if the 'userID' key exists in the $row array before using it
        if (isset($row['userID'])) {
            // Delete friend form
            echo '<form action="delete_friend.php" method="post" style="display: inline;">';
            echo '<input type="hidden" name="currentUserId" value="' . htmlspecialchars($currentUserId) . '">';
            echo '<input type="hidden" name="friendUserId" value="' . htmlspecialchars($row['userID']) . '">';
            echo '<input type="submit" name="deleteFriend" value="Delete Friend">';
            echo '</form>';
    
            // Add friend form
            echo '<form action="add_friend.php" method="post" style="display: inline;">';
            echo '<input type="hidden" name="fromID" value="' . htmlspecialchars($currentUserId) . '">';
            echo '<input type="hidden" name="toID" value="' . htmlspecialchars($row['userID']) . '">';
            echo '<input type="submit" name="addFriend" value="Add Friend">';
            echo '</form>';
        } else {
            echo 'Error: userID is missing for this friend.';
        }
        echo "</li>";
    }
    
    echo "</ul>"; // End the list
} else {
    echo "User ID not specified.";
}
?>