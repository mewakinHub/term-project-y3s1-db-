<!-- delete_tag.php -->
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
    $tagID = intval($_GET["id"]);

    $deleteTagSql = "DELETE FROM tag WHERE tagID=?";
    $stmtDeleteTag = $mysqli->prepare($deleteTagSql);
    $stmtDeleteTag->bind_param('i', $tagID);

    if ($stmtDeleteTag->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmtDeleteTag->error . "</p>";
    }

    $stmtDeleteTag->close();
}

$mysqli->close();
?>
