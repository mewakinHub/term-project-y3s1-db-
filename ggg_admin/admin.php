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

error_reporting(E_ALL);
ini_set('display_errors', true);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #3498db;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>

    <h1>Welcome, Admin!</h1>
    <p><a href="?logout=true">Logout</a></p>

    <!-- Display section for Games -->
    <section>
        <h2>Games</h2>
        <p><a href='add_game.php'>Add New Game</a></p>
        <?php include_once('admin_display_table.php'); displayTable($mysqli, 'game', ['gameID', 'name', 'price', 'releaseDate', 'shortdesc', 'description']); ?>
    </section>

    <!-- Display section for Studios -->
    <section>
        <h2>Studios</h2>
        <p><a href='add_studio.php'>Add New Studio</a></p>
        <?php displayTable($mysqli, 'studio', ['studioID', 'name']); ?>
    </section>

    <!-- Display section for Tags -->
    <section>
        <h2>Tags</h2>
        <p><a href='add_tag.php'>Add New Tag</a></p>
        <?php displayTable($mysqli, 'tag', ['tagID', 'name']); ?>
    </section>

    <!-- Display section for Users -->
    <section>
        <h2>Users</h2>
        <p><a href='add_user.php'>Add New User</a></p>
        <?php displayTable($mysqli, 'user', ['userID', 'email', 'password', 'username', 'balance', 'bio', 'profilePicFile']); ?>
    </section>

    <!-- Display section for Media -->
    <section>
        <h2>Media</h2>
        <p><a href='add_media.php'>Add New Media</a></p>
        <?php displayTable($mysqli, 'media', ['mediaID', 'file', 'gameID']); ?>
    </section>

    <!-- Display section for Game Studios -->
    <section>
        <h2>Game Studios</h2>
        <p><a href='add_game_studio.php'>Add New Game Studio</a></p>
        <?php displayTable($mysqli, 'game_studio', ['gameID', 'studioID', 'type']); ?>
    </section>

    <!-- Display section for Game Tags -->
    <section>
        <h2>Game Tags</h2>
        <p><a href='add_game_tag.php'>Add New Game Tag</a></p>
        <?php displayTable($mysqli, 'game_tag', ['gameID', 'tagID']); ?>
    </section>

    <!-- Display section for Featured Games -->
    <section>
        <h2>Featured Games</h2>
        <p><a href='add_featured.php'>Add Featured Game</a></p>
        <?php displayTable($mysqli, 'featured', ['featuredID', 'type', 'gameID']); ?>
    </section>

    <?php
    // Close the database connection
    $mysqli->close();
    ?>
</body>
</html>
