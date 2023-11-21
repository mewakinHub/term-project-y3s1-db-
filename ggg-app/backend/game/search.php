<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connect.php");

// Check if the 'search' parameter is set
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    // echo "Search Query: " . $search . "<br>";


    $sql = "SELECT gameID, name, price, icon, poster FROM game WHERE name LIKE '%$search%' OR shortdesc LIKE '%$search%'";
    $result = $conn->query($sql);

    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Display the search results
    echo "<div class='searched-games'>"; // Start the container for searched games
    while ($row = $result->fetch_assoc()) {
        echo "<div class='game'>"; // Game container
        // Display game information
        echo "Game ID: " . $row['gameID'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        echo "Price: ฿" . $row['price'] . "<br>";

        // Display the game poster
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['poster']) . '" alt="Poster for ' . htmlspecialchars($row['name']) . '" class="game-poster">';
        echo "</div>"; 
    }
    echo "</div>"; 
} else {
    echo "Search parameter not specified.";
}
?>
