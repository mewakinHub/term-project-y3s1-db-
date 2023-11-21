<!-- add_game.php -->
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

// Add new game logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $releaseDate = $_POST["releaseDate"];
    $shortdesc = $_POST["shortdesc"];
    $description = $_POST["description"];

    // Check if an image is uploaded for icon
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
        $iconData = file_get_contents($_FILES['icon']['tmp_name']);
    } else {
        // No icon image uploaded, display a message and a button to go back
        echo "<p>No icon image uploaded. Please go back to the previous page.</p>";
        echo "<button onclick='history.go(-1);'>Go Back</button>";
        exit;
    }

    // Check if an image is uploaded for poster
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $posterData = file_get_contents($_FILES['poster']['tmp_name']);
    } else {
        // No poster image uploaded, display a message and a button to go back
        echo "<p>No poster image uploaded. Please go back to the previous page.</p>";
        echo "<button onclick='history.go(-1);'>Go Back</button>";
        exit;
    }

    // Use prepared statement to avoid SQL injection
    $stmt = $mysqli->prepare("INSERT INTO game (name, price, releaseDate, shortdesc, description, icon, poster) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsssss", $name, $price, $releaseDate, $shortdesc, $description, $iconData, $posterData);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game</title>
</head>
<body>

    <h1>Add New Game</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>

        <label for="releaseDate">Release Date:</label>
        <input type="date" id="releaseDate" name="releaseDate" required><br>

        <label for="shortdesc">Short Description:</label>
        <textarea id="shortdesc" name="shortdesc" required></textarea><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="icon">Icon:</label>
        <input type="file" id="icon" name="icon" accept="image/*" required><br>

        <label for="poster">Poster:</label>
        <input type="file" id="poster" name="poster" accept="image/*" required><br>

        <input type="submit" value="Add Game">
    </form>

</body>
</html>
