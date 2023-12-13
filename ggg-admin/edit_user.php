<!-- edit_user.php -->
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
    $userID = $_POST["userID"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $username = $_POST["username"];
    $balance = $_POST["balance"];
    $bio = $_POST["bio"];

    // Check if an image is uploaded for profile picture
    if (isset($_FILES['profilePicFile']) && $_FILES['profilePicFile']['error'] === UPLOAD_ERR_OK) {
        $profilePicData = file_get_contents($_FILES['profilePicFile']['tmp_name']);
    } else {
        // No profile picture uploaded, keep the existing one
        $sqlGetPic = "SELECT profilePicFile FROM user WHERE userID=?";
        $stmtGetPic = $mysqli->prepare($sqlGetPic);
        $stmtGetPic->bind_param('i', $userID);
        $stmtGetPic->execute();
        $stmtGetPic->store_result();
        
        if ($stmtGetPic->num_rows > 0) {
            $stmtGetPic->bind_result($existingPic);
            $stmtGetPic->fetch();
            $profilePicData = $existingPic;
        }
        
        $stmtGetPic->close();
    }

    $sql = "UPDATE user SET email=?, password=?, username=?, balance=?, bio=?, profilePicFile=? WHERE userID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssssi', $email, $password, $username, $balance, $bio, $profilePicData, $userID);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    $userID = $_GET["id"];
    $sql = "SELECT * FROM user WHERE userID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $username = $row["username"];
        $balance = $row["balance"];
        $bio = $row["bio"];
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
    <title>Edit User</title>
</head>
<body>

    <h2>Edit User</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password">
        <br>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required>
        <br>
        <label>Balance:</label>
        <input type="text" name="balance" value="<?php echo $balance; ?>" required>
        <br>
        <label>Bio:</label>
        <textarea name="bio" required><?php echo $bio; ?></textarea>
        <br>
        <label>Profile Picture:</label>
        <input type="file" name="profilePicFile" accept="image/*">
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
