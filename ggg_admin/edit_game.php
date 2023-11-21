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

// Logout logic
if (isset($_GET["logout"]) && $_GET["logout"] == true) {
    $_SESSION["admin_loggedin"] = false;
    session_destroy();
    header("Location: login.php");
    exit;
}

// Edit game logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameID = $_POST["gameID"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $releaseDate = $_POST["releaseDate"];
    $shortdesc = $_POST["shortdesc"];
    $description = $_POST["description"];

    // Validate input, you can add more validation as needed

    $sql = "UPDATE game SET name='$name', price='$price', releaseDate='$releaseDate', shortdesc='$shortdesc', description='$description' WHERE gameID='$gameID'";

    if ($mysqli->query($sql)) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
} else {
    $gameID = $_GET["id"];
    $sql = "SELECT * FROM game WHERE gameID='$gameID'";
    $result = $mysqli->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $price = $row["price"];
        $releaseDate = $row["releaseDate"];
        $shortdesc = $row["shortdesc"];
        $description = $row["description"];
    } else {
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
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

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
        <input type="submit" value="Update">
    </form>

</body>
</html>
