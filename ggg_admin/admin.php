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
// In PHP, the session_start() function must be called at the beginning of every script where you want to work with session variables. 
// If you want to access the $_SESSION variables across different files, you need to call session_start() in each of those files.
// $_SESSION Array: user's session

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

    <!-- a logout button -->
    <p><a href="?logout=true">Logout</a></p>

    <section>
        <h2>Games</h2>
        <p><a href='add_game.php'>Add New Game</a></p>

        <?php
        // Perform SQL query for displaying games
        $sqlGames = "SELECT * FROM game";
        $resultGames = $mysqli->query($sqlGames);

        if ($resultGames) {
            echo "<table>
                    <tr>
                        <th>Game ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Release Date</th>
                        <th>Short Description</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            while ($row = $resultGames->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['gameID']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['releaseDate']}</td>
                        <td>{$row['shortdesc']}</td>
                        <td>{$row['description']}</td>
                        <td><a href='edit_game.php?gameID={$row['gameID']}'>Edit</a></td>
                        <td><button class='delete-btn' onclick='if(confirmDelete()) window.location.href=\"delete_game.php?gameID={$row['gameID']}\";'>Delete</button></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Error: " . $mysqli->error . "</p>";
        }
        ?>
    </section>

    <section>
        <h2>Studios</h2>
        <p><a href='add_studio.php'>Add New Studio</a></p>

        <?php
        // Perform SQL query for displaying studios
        $sqlStudios = "SELECT * FROM studio";
        $resultStudios = $mysqli->query($sqlStudios);

        if ($resultStudios) {
            echo "<table>
                    <tr>
                        <th>Studio ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            while ($row = $resultStudios->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['studioID']}</td>
                        <td>{$row['name']}</td>
                        <td><a href='edit_studio.php?studioID={$row['studioID']}'>Edit</a></td>
                        <td><button class='delete-btn' onclick='if(confirmDelete()) window.location.href=\"delete_studio.php?studioID={$row['studioID']}\";'>Delete</button></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Error: " . $mysqli->error . "</p>";
        }
        ?>
    </section>

    <section>
        <h2>Tags</h2>
        <p><a href='add_tag.php'>Add New Tag</a></p>

        <?php
        // Perform SQL query for displaying tags
        $sqlTags = "SELECT * FROM tag";
        $resultTags = $mysqli->query($sqlTags);

        if ($resultTags) {
            echo "<table>
                    <tr>
                        <th>Tag ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            while ($row = $resultTags->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['tagID']}</td>
                        <td>{$row['name']}</td>
                        <td><a href='edit_tag.php?tagID={$row['tagID']}'>Edit</a></td>
                        <td><button class='delete-btn' onclick='if(confirmDelete()) window.location.href=\"delete_tag.php?tagID={$row['tagID']}\";'>Delete</button></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Error: " . $mysqli->error . "</p>";
        }
        ?>
    </section>

    <section>
        <h2>Users</h2>
        <p><a href='add_users.php'>Add Users</a></p>

        <?php
        // Perform SQL query for displaying users
        $sqlUsers = "SELECT * FROM user";
        $resultUsers = $mysqli->query($sqlUsers);

        if ($resultUsers) {
            echo "<table>
                    <tr>
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Username</th>
                        <th>Balance</th>
                        <th>Bio</th>
                        <th>Profile Picture</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            while ($row = $resultUsers->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['userID']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['balance']}</td>
                        <td>{$row['bio']}</td>
                        <td>{$row['profilePicFile']}</td>
                        <td><a href='edit_user.php?userID={$row['userID']}'>Edit</a></td>
                        <td><button class='delete-btn' onclick='if(confirmDelete()) window.location.href=\"delete_user.php?userID={$row['userID']}\";'>Delete</button></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Error: " . $mysqli->error . "</p>";
        }
        ?>
    </section>

    <?php
    // Close the database connection
    $mysqli->close();
    ?>
</body>
</html>
