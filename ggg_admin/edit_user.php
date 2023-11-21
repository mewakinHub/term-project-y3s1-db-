<!-- edit_user.php -->
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "ggg";

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($mysqli->errno) {
    echo("Connection failed: " . $mysqli->connect_error);
    exit;
}

// Check if the userID parameter is set
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch user data based on userID
    $selectSql = "SELECT * FROM user WHERE userID = ?";
    $stmtSelect = $mysqli->prepare($selectSql);

    if ($stmtSelect) {
        $stmtSelect->bind_param('i', $userID);

        if ($stmtSelect->execute()) {
            $result = $stmtSelect->get_result();

            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
            } else {
                echo "User not found.";
                exit;
            }
        } else {
            echo "Error fetching user data: " . $stmtSelect->error;
            exit;
        }

        $stmtSelect->close();
    } else {
        echo "Error preparing select statement: " . $mysqli->error;
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}

// Check if the form is submitted for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the update SQL for specific fields
    $updateSql = "UPDATE user SET email = ?, password = ?, username = ?, balance = ?, bio = ? WHERE userID = ?";
    $stmtUpdate = $mysqli->prepare($updateSql);

    if ($stmtUpdate) {
        // Bind parameters
        $stmtUpdate->bind_param('sssssi', $_POST['email'], $_POST['password'], $_POST['username'], $_POST['balance'], $_POST['bio'], $userID);

        if ($stmtUpdate->execute()) {
            echo "User data updated successfully!";
            // Redirect back to admin.php
            header("Location: admin.php");
            exit;
        } else {
            echo "Error updating user data: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    } else {
        echo "Error preparing update statement: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $userData['password']; ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required><br>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" step="0.01" value="<?php echo $userData['balance']; ?>" required><br>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"><?php echo $userData['bio']; ?></textarea><br>

        <input type="submit" value="Update User">
    </form>
</body>
</html>
