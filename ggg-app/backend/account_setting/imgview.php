<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php"); // Ensure this file properly sets up the connection

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $sql = "SELECT profilePicFile FROM user WHERE userID = ?"; // Use your actual table name
    $statement = $conn->prepare($sql);

    if ($statement === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $statement->bind_param("i", $userId); // Bind the user_id parameter from the URL
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . htmlspecialchars($statement->error));
    $result = $statement->get_result();

    if ($row = $result->fetch_assoc()) {
        // Check if the BLOB data is actually there
        if (empty($row['profilePicFile'])) {
            echo "Image data is empty.";
        } else {
            // Determine the correct MIME type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($row['profilePicFile']);
            
            // Output the image with the correct MIME type
            echo '<i<img src="data:image/jpg;base64,' .  ';base64,' . base64_encode($row['profilePicFile']) . '" alt="User profile picture" style="width: 500px;" />';
        }
    } else {
        echo "Image not found."; // In case the user_id does not exist or has no image
    }
} else {
    echo "User ID not specified."; // In case user_id is not provided in the URL
}
?>
