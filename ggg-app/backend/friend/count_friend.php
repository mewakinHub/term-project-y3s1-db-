<?php
//http://localhost:8888/backend/friend/count_friend.php?userID=1


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

if (isset($_GET['userID'])) { 
    $userID = $_GET['userID']; 
    $sql =  "SELECT COUNT(DISTINCT u.userID) AS friendCount
             FROM user u
             JOIN friend f ON u.userID = f.toID OR u.userID = f.fromID
             WHERE (f.fromID = ? OR f.toID = ?) AND u.userID != ?;";

    $stmt = $conn->prepare($sql);
   
    $stmt->bind_param("iii", $userID, $userID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo "User ID $userID has " . $row['friendCount'] . " friends."; // Now using 'userID'
} else {
    echo "User ID not provided.";
}


?>
