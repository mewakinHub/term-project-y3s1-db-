<?php

//test
http://localhost:8888/backend/friend/display_friend.php?userID=1

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

if (isset($_GET['userID'])) {
    $currentUserId = $_GET['userID']; // Use 'userID' consistently throughout

    $sql = "SELECT u.userID, u.username, u.profilePicFile 
            FROM user u
            JOIN friend f ON u.userID = f.toID OR u.userID = f.fromID
            WHERE (f.fromID = ? OR f.toID = ?) AND u.userID != ?;";

    $statement = $conn->prepare($sql);

    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $statement->bind_param("iii", $currentUserId, $currentUserId, $currentUserId);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Friends List<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        if (!empty($row['profilePicFile'])) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profilePicFile']) . '" alt="Profile picture" style="width: 50px; height: 50px; border-radius: 50%;"> ';
        } else {
            echo '<img src="/backend/friend/user%20(2).png" style="width: 50px; height: 50px; border-radius: 50%;">';
        }
        echo htmlspecialchars($row['username']);
        if (isset($row['userID'])) {
            echo '<form action="delete_friend.php" method="post" style="display: inline;">';
            echo '<input type="hidden" name="currentUserId" value="' . htmlspecialchars($currentUserId) . '">';
            echo '<input type="hidden" name="friendUserId" value="' . htmlspecialchars($row['userID']) . '">';
            echo '<input type="submit" name="deleteFriend" value="Delete Friend">';
            echo '</form>';

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
    echo "</ul>";
} else {
    echo "User ID not specified.";
}

?>