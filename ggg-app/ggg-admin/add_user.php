<!-- add_user.php -->
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "ggg";

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->errno) {
    echo("Connection failed: " . $mysqli->connect_error);
}

session_start();

if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $username = $_POST["username"];
    $balance = $_POST["balance"];
    $bio = $_POST["bio"];

    // Check if an image is uploaded for profile picture
    if (isset($_FILES['profilePicFile']) && $_FILES['profilePicFile']['error'] === UPLOAD_ERR_OK) {
        $profilePicData = file_get_contents($_FILES['profilePicFile']['tmp_name']);
    }

    $stmt = $mysqli->prepare("INSERT INTO user (email, password, username, balance, bio, profilePicFile) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $password, $username, $balance, $bio, $profilePicData);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
</head>
<body>

    <h1>Add New User</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="balance">Balance:</label>
        <input type="text" id="balance" name="balance" required><br>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio" required></textarea><br>

        <label for="profilePicFile">Profile Picture File:</label>
        <input type="file" id="profilePicFile" name="profilePicFile" accept="image/*"><br>

        <input type="submit" value="Add User">
    </form>

</body>
</html>
