<?php
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once('connect.php');



// Check if the form has been submitted
if (isset($_POST['delete_user'])) {
    // Check if the userID is set and not empty
    if (isset($_POST['userID']) && !empty($_POST['userID'])) {
        $userID = $_POST['userID'];

        // Prepare a statement for delete
        $stmt = $conn->prepare("DELETE FROM `user` WHERE `userID` = ?");
        $stmt->bind_param("i", $userID);

        if (!$stmt->execute()) {
            echo "DELETE failed. Error: " . $stmt->error;
        } else {
            // Success message
            echo "User with ID $userID has been successfully deleted.";

            // Redirect to profile page or home page after deletion
            header("Location: profile.php");
            exit;
        }

        $stmt->close();
    } else {
        echo "User ID is not provided.";
    }
} else {
    echo "User is not logged in.";
}

$conn->close();
?>
