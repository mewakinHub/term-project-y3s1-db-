<?php

// Include database connection
require_once("connect.php");

function addFriend($fromID, $toID, $conn) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO friend (fromID, toID) VALUES (?, ?)");
    $stmt->bind_param("ii", $fromID, $toID);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "Friend request sent!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Check if the form was submitted
if (isset($_POST['addFriend'])) {
    // Call the addFriend function with the POST data
    addFriend($_POST['fromID'], $_POST['toID'], $conn);
}

?>
