<?php
// Start the session
session_start();

// Check if the 'userID' is set in the query parameters
if (isset($_GET['userID'])) {
    $_SESSION['userID'] = $_GET['userID'];
}

echo "User ID in session: " . $_SESSION['userID'] . "<br>";

// Check if the 'userID' is set in the session, if not, exit with an error message
if (!isset($_SESSION['userID'])) {
    die("User ID not specified.");
}

// Check if 'gameID' is set in the form submission
if (isset($_GET['gameID'])) {
    $gameID = $_GET['gameID'];
    // Handle the gameID as needed
} else {
    // 'gameID' is not set, handle the situation accordingly
    echo "Game ID not specified.";
}

?>

<form action="search.php" method="GET">
    <!-- Include the user ID in the form as a hidden input -->
    <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search" placeholder="Enter game name">
    
    <!-- Include the game ID in the form as a hidden input -->
    <input type="hidden" name="gameID" value="<?php echo $gameID; ?>">

    <button type="submit">Search</button>
</form>
