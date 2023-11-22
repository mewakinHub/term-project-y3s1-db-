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
    $mediaID = $_POST["mediaID"]; // current mediaID [can't edit]
    $gameID = $_POST["gameID"];

    // Check if an image is uploaded for media
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $mediaData = file_get_contents($_FILES['file']['tmp_name']);
        
        // Update the mediaFile for the specified mediaID
        $updateMediaSql = "UPDATE media SET file=? WHERE mediaID=?";
        $stmtUpdateMedia = $mysqli->prepare($updateMediaSql);
        $stmtUpdateMedia->bind_param('si', $mediaData, $mediaID);
        $stmtUpdateMedia->execute();
        $stmtUpdateMedia->close();
    }

    // Update the gameID for the specified mediaID
    $sql = "UPDATE media SET gameID=? WHERE mediaID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $gameID, $mediaID);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: admin.php");
        exit;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
        $stmt->close();
    }
} else {
    // retrieve the existing information from the database for the specified game if the update operation fails or if the request method is not POST (i.e., when the page is initially loaded for editing).
    $mediaID = $_GET["id"];
    $sql = "SELECT * FROM media WHERE mediaID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $mediaID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $file = $row["file"];
        $gameID = $row["gameID"];
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
    <title>Edit Media</title>
</head>
<body>

    <h2>Edit Media</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="mediaID" value="<?php echo $mediaID; ?>">
        <label>Media File:</label>
        <input type="file" name="file" accept="image/*" require>
        <br>
        <label>GameID:</label>
        <input type="text" name="gameID" value="<?php echo $gameID; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
