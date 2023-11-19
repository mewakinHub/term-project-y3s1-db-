<?php

session_start();

// session_start(); 
echo "<pre>Session variables in 'upload.php': ";
print_r($_SESSION);
echo "</pre>";
require("connect.php");

// Check if an image file was sent and the userID is set
if (isset($_FILES["image"], $_POST["userID"]) && $_FILES["image"]["error"] == 0) {
    $userID = $_POST["userID"];
    $image = $_FILES["image"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($image)); // addslashes is used to escape special characters

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE user SET profilePicFile = ? WHERE userID = ?");
    $stmt->bind_param('si', $imgContent, $userID); // 's' for string/blob data, 'i' for integer userID

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION["success"] = "Image uploaded successfully";
    } else {
        $_SESSION["error"] = "Error uploading image: " . $stmt->error;
    }

    $stmt->close();
    // Redirect back to the update_user.php
    header("Location: update_user.php?userID=$userID");
} else {
    $_SESSION["error"] = "Please select an image file to upload.";
    // Redirect back to the update_user.php
    header("Location: update_user.php?userID=" . ($_POST["userID"] ?? ''));
}
exit();
?>