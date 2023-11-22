<!-- add_media.php -->
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
    $gameID = $_POST["gameID"];

    // Check if a file is uploaded for media
    if (isset($_FILES['mediaFile']) && $_FILES['mediaFile']['error'] === UPLOAD_ERR_OK) {
        $mediaData = file_get_contents($_FILES['mediaFile']['tmp_name']);
    } else {
        // No media file uploaded, display a message and a button to go back
        echo "<p>No media file uploaded. Please go back to the previous page.</p>";
        echo "<button onclick='history.go(-1);'>Go Back</button>";
        exit;
    }

    $stmt = $mysqli->prepare("INSERT INTO media (file, gameID) VALUES (?, ?)");
    $stmt->bind_param("si", $mediaData, $gameID);

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
    <title>Add New Media</title>
</head>
<body>

    <h1>Add New Media</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label for="mediaFile">Media File:</label>
        <input type="file" id="mediaFile" name="mediaFile" accept="video/*,audio/*,image/*" required><br>

        <label for="gameID">Game ID:</label>
        <input type="text" id="gameID" name="gameID" required><br>

        <input type="submit" value="Add Media">
    </form>

</body>
</html>
