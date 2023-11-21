<?php
//test
//http://localhost:8888/backend/friend/add_friend.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include database connection
require_once("connect.php"); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Friend Form</title>
</head>
<body>
    <h2>Add Friend</h2>
    <form action="add_friend.php" method="post">
        <label for="fromID">Your User ID:</label>
        <input type="text" id="fromID" name="fromID" required><br><br>
        
        <label for="toID">Friend's User ID:</label>
        <input type="text" id="toID" name="toID" required><br><br>
        
        <input type="submit" value="Send Friend Request">
        
       <?php
        
        // Call the AddFriend stored procedure
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fromID'], $_POST['toID'])) {
            // Call the AddFriend stored procedure
            $stmt = $conn->prepare("CALL AddFriend(?, ?)");
            $stmt->bind_param("ii", $fromUserID, $toUserID);
            $fromUserID = $_POST['fromID']; 
            $toUserID = $_POST['toID']; 
        
            if ($stmt->execute()) {
                echo "Friend request sent!";
            } else {
                echo "Error: " . $stmt->error;
            }
        
            $stmt->close();
        }

        
        
        ?>
    </form>
</body>
</html>
