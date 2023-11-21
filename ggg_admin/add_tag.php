<!-- add_tag.php -->
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
    $name = $_POST["name"];

    $stmt = $mysqli->prepare("INSERT INTO tag (name) VALUES (?)");
    $stmt->bind_param("s", $name);

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
    <title>Add New Tag</title>
</head>
<body>

    <h1>Add New Tag</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <input type="submit" value="Add Tag">
    </form>

</body>
</html>
