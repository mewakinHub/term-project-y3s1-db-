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
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// when the form may not have a specific submit button or when multiple forms are present on a page.
// }
// Check if the form is submitted for adding a new user
if (isset($_POST['submit'])) {
    // Use mysqli_real_escape_string for each form field(defense against SQL injection attacks.)
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $balance = mysqli_real_escape_string($mysqli, $_POST['balance']);
    $bio = mysqli_real_escape_string($mysqli, $_POST['bio']);

    // Hash the password before storing it(cryptographic)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the insert statement
    $insertSql = "INSERT INTO user (email, password, username, balance, bio) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $mysqli->prepare($insertSql);

    if ($stmtInsert) {
        // 'sssss': string type assigned for all var.
        $stmtInsert->bind_param('sssss', $email, $hashedPassword, $username, $balance, $bio);

        if ($stmtInsert->execute()) {
            echo "User added successfully!";
            // Redirect back to admin.php after adding user
            header("Location: admin.php");
            exit;
        } else {
            echo "Error adding user: " . $stmtInsert->error;
        }

        $stmtInsert->close();
    } else {
        echo "Error preparing insert statement: " . $mysqli->error;
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
    <title>Add User</title>
</head>
<body>
    <h1>Add User</h1>

    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" step="0.01" required><br>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"></textarea><br>

        <input type="submit" name="submit" value="Add User">
    </form>
</body>
</html>
