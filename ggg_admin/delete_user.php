<!-- delete_user.php -->
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
    $userID = intval($_GET["id"]);

    $deleteUserSql = "DELETE FROM user WHERE userID=?";
    $stmtDeleteUser = $mysqli->prepare($deleteUserSql);
    $stmtDeleteUser->bind_param('i', $userID);

    if ($stmtDeleteUser->execute()) {
        header("Location: admin.php");
    } else {
        echo "<p>Error: " . $stmtDeleteUser->error . "</p>";
    }

    $stmtDeleteUser->close();
}

$mysqli->close();
?>
