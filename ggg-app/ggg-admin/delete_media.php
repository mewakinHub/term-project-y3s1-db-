<!-- delete_media.php -->
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mediaID = intval($_GET["id"]);

    $deleteMediaSql = "DELETE FROM media WHERE mediaID=?";
    $stmtDeleteMedia = $mysqli->prepare($deleteMediaSql);
    $stmtDeleteMedia->bind_param('i', $mediaID);

    if ($stmtDeleteMedia->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmtDeleteMedia->error . "</p>";
    }

    $stmtDeleteMedia->close();
}

$mysqli->close();
?>
