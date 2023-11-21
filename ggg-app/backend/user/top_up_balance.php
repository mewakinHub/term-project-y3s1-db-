<?php
//test
//http://localhost:8888/backend/user/top_up_balance.php?userID=1

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
    $userID = 0; // Default to 0 if not found
}

// Fetch the current balance from the database for the user
if ($userID > 0) {
    $stmt = $conn->prepare("SELECT balance FROM user WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentBalance = $row['balance'];
        } else {
            echo "<p>User not found.</p>";
        }
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Check if the form was submitted for top-up
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['topUpAmount']) && $userID > 0) {
    // Call the TopUpBalance stored procedure
    $topUpAmount = $_POST['topUpAmount'];
    $stmt = $conn->prepare("CALL TopUpBalance(?, ?)");
    $stmt->bind_param("id", $userID, $topUpAmount);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Balance topped up successfully!";
    } else {
        $_SESSION['error'] = "Error executing the stored procedure: " . $stmt->error;
    }
    $stmt->close();

    // Redirect back to the balance page with the updated balance
    header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"]) . "?userID=" . urlencode($userID));
    exit;
}

// If there's a message in the session, display it and clear it
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<p>{$_SESSION['error']}</p>";
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top Up Balance</title>
</head>
<body>
    <h2>Top Up Your Balance</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?userID=' . urlencode($userID); ?>" method="post">
        <input type="hidden" id="userID" name="userID" value="<?php echo $userID; ?>">
        <p>Current balance: <span id="currentBalance">฿<?php echo number_format($currentBalance, 2); ?></span></p>
        <!-- Top-up buttons here -->
        <button type="submit" name="topUpAmount" value="100.00">Add ฿100.00</button>
        <button type="submit" name="topUpAmount" value="150.00">Add ฿150.00</button>
        <button type="submit" name="topUpAmount" value="300.00">Add ฿300.00</button>
        <button type="submit" name="topUpAmount" value="500.00">Add ฿500.00</button>
        <button type="submit" name="topUpAmount" value="1000.00">Add ฿1000.00</button>
    </form>
</body>
</html>
