<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require("connect.php");

// Check if an image file was sent and the userID is set
if (isset($_FILES["image"], $_POST["userID"])) {
    // Validate the file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES["image"]["type"];
    if (!in_array($fileType, $allowedTypes)) {
        $_SESSION["error"] = "Only JPG, PNG, and GIF files are allowed.";
        // Redirect back to the update_user.php with an error
        header("Location: update_user.php?userID=" . ($_POST["userID"] ?? ''));
        exit();
    }

    if ($_FILES["image"]["error"] == 0) {
        $userID = $_POST["userID"];
        $image = $_FILES["image"]["tmp_name"];
        $imgContent = file_get_contents($image); // Removed addslashes()

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
        // Handle file upload error
        $_SESSION["error"] = "Error uploading image: " . $_FILES["image"]["error"];
        header("Location: update_user.php?userID=" . ($_POST["userID"] ?? ''));
    }
} else {
    $_SESSION["error"] = "Please select an image file to upload.";
    // Redirect back to the update_user.php
    header("Location: update_user.php?userID=" . ($_POST["userID"] ?? ''));
}
exit();
?>
