<!-- edit_user.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connect.php");

// Edit user logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST["userID"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $balance = $_POST["balance"];
    $bio = $_POST["bio"];

    // Validate input, you can add more validation as needed

    $sql = "UPDATE user SET email='$email', password='$password', username='$username', balance='$balance', bio='$bio' WHERE userID='$userID'";

    if ($conn->query($sql)) {
        header("Location: /backend/account_setting/edit_user.php?userID=$userID");
        exit;
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
} else {
    $userID = $_GET["userID"];
    $sql = "SELECT * FROM user WHERE userID='$userID'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $password = $row["password"];
        $username = $row["username"];
        $balance = $row["balance"];
        $bio = $row["bio"];
    } else {
        echo "<p>User not found or error: " . $conn->error . "</p>";
        // You might want to handle the case where the user is not found
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

    <h2>Edit User</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $password; ?>" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required>
        <br>
        <label>Balance:</label>
        <input type="text" name="balance" value="<?php echo $balance; ?>" required>
        <br>
        <label>Bio:</label>
        <input type="text" name="bio" value="<?php echo $bio; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
