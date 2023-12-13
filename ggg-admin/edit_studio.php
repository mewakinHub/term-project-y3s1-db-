<!-- edit_studio.php -->
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

// Edit studio logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studioID = $_POST["studioID"];
    $name = $_POST["name"];

    // Validate input, you can add more validation as needed

    $sql = "UPDATE studio SET name=? WHERE studioID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $name, $studioID);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
} else {
    $studioID = $_GET["id"];
    $sql = "SELECT * FROM studio WHERE studioID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $studioID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
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
    <title>Edit Studio</title>
</head>
<body>

    <h2>Edit Studio</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- hidden input: studioID [current studioID: can edit] -->
        <input type="hidden" name="studioID" value="<?php echo $studioID; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
