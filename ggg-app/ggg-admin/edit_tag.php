<!-- edit_tag.php -->
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
    $tagID = $_POST["tagID"];
    $name = $_POST["name"];

    $sql = "UPDATE tag SET name=? WHERE tagID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $name, $tagID);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    $tagID = $_GET["id"];
    $sql = "SELECT * FROM tag WHERE tagID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $tagID);
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
    <title>Edit Tag</title>
</head>
<body>

    <h2>Edit Tag</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="tagID" value="<?php echo $tagID; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
