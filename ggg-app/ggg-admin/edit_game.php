<!-- edit_game.php -->
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

session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Edit game logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameID = $_POST["gameID"]; //current gameID[can't edit]
    $name = $_POST["name"];
    $price = $_POST["price"];
    $releaseDate = $_POST["releaseDate"];
    $shortdesc = $_POST["shortdesc"];
    $description = $_POST["description"];

    // Validate input, you can add more validation as needed
    // Check if an image is uploaded for icon
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
        $iconData = file_get_contents($_FILES['icon']['tmp_name']);
        $updateIconSql = "UPDATE game SET icon=? WHERE gameID=?";
        $stmtUpdateIcon = $mysqli->prepare($updateIconSql);
        $stmtUpdateIcon->bind_param('si', $iconData, $gameID);
        $stmtUpdateIcon->execute();
        $stmtUpdateIcon->close();
    }

    // Check if an image is uploaded for poster
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $posterData = file_get_contents($_FILES['poster']['tmp_name']);
        $updatePosterSql = "UPDATE game SET poster=? WHERE gameID=?";
        $stmtUpdatePoster = $mysqli->prepare($updatePosterSql);
        $stmtUpdatePoster->bind_param('si', $posterData, $gameID);
        $stmtUpdatePoster->execute();
        $stmtUpdatePoster->close();
    }

    // Update the other game information
    $sql = "UPDATE game SET name=?, price=?, releaseDate=?, shortdesc=?, description=? WHERE gameID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssi', $name, $price, $releaseDate, $shortdesc, $description, $gameID);

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
    $gameID = $_GET["id"];
    $sql = "SELECT * FROM game WHERE gameID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $gameID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $price = $row["price"];
        $releaseDate = $row["releaseDate"];
        $shortdesc = $row["shortdesc"];
        $description = $row["description"];
        $icon = $row["icon"];
        $poster = $row["poster"];
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
    <title>Edit Game</title>
</head>
<body>

    <h2>Edit Game</h2>

    <!-- when you use <input type="file"> for file uploads, you need to set the enctype attribute to "multipart/form-data". -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <!-- hidden input: gameID [current gameID: can't edit] -->
        <input type="hidden" name="gameID" value="<?php echo $gameID; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br>
        <label>Price:</label>
        <input type="text" name="price" value="<?php echo $price; ?>" required>
        <br>
        <label>Release Date:</label>
        <input type="text" name="releaseDate" value="<?php echo $releaseDate; ?>" required>
        <br>
        <label>Short Description:</label>
        <input type="text" name="shortdesc" value="<?php echo $shortdesc; ?>" required>
        <br>
        <label>Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>" required>
        <br>
        <label>Icon:</label>
        <input type="file" name="icon" accept="image/*">
        <br>
        <label>Poster:</label>
        <input type="file" name="poster" accept="image/*">
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
