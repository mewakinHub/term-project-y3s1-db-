<?php
// Display current balance only
// test
// http://localhost:8888/backend/balance/current_balance.php?userID=1

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); // Start the session at the beginning of the script

// Include database connection
require_once("connect.php");

// Initialize the balance
$currentBalance = 0.00;

// Retrieve user ID either from session or GET parameter
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} elseif (isset($_GET['userID'])) {
    $userID = intval($_GET['userID']);
    $_SESSION['userID'] = $userID; // Store it in the session for subsequent use
} else {
    echo "User ID not specified.";
    exit; // Exit the script if the user ID is not specified
}

// Fetch the current balance from the database for the user
$stmt = $conn->prepare("SELECT balance FROM user WHERE userID = ?");
$stmt->bind_param("i", $userID);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentBalance = $row['balance'];
    } else {
        echo "<p>User not found.</p>";
        exit; // Exit the script if the user is not found
    }
} else {
    echo "<p>Error: " . $stmt->error . "</p>";
    exit; // Exit the script if there is an error executing the statement
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Balance</title>
</head>
<body>
    <h2>Your Current Balance</h2>
    <p>Current balance: <span id="currentBalance">฿<?php echo number_format($currentBalance, 2); ?></span></p>
</body>
</html>