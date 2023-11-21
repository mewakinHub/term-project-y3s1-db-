<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Search</title>
</head>
<body>

    <h1>Game Search in Library</h1>

    <?php
    // Start the session
    session_start();
    echo "User ID in session: " . $_SESSION['userID'] . "<br>";


    // Check if the 'userID' is set in the session, if not, exit with an error message
    if (!isset($_SESSION['userID'])) {
        die("User ID not specified.");
    }

    $currentUserId = $_SESSION['userID'];
    ?>

    <form action="search.php" method="GET">
        <!-- Include the user ID in the form as a hidden input -->
        <input type="hidden" name="userID" value="<?php echo $currentUserId; ?>">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter game name">
        <button type="submit">Search</button>
    </form>

</body>
</html>
