<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include database connection
require_once("connect.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Call the AddInstalledGame stored procedure
    $stmt = $conn->prepare("CALL AddInstalledGame(?, ?)");
    $stmt->bind_param("ii", $userID, $gameID);
    $userID = $_POST['userID']; 
    $gameID = $_POST['gameID']; 
    
    if ($stmt->execute()) {
        echo "<p>Game added to installed list!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Installed Game</title>
</head>
<body>
    <h2>Add Installed Game</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="userID">Your User ID:</label>
        <input type="text" id="userID" name="userID" required><br><br>
        
        <label for="gameID">Game ID:</label>
        <input type="text" id="gameID" name="gameID" required><br><br>
        
        <input type="submit" value="Add Game as Installed">
    </form>
</body>
</html>
